<?php

namespace App\Console\Commands;

use App\InstagramMediaMetric;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class SyncInstagramMediaMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:sync-media-metrics {--days=60} {--limit=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza métricas por publicação do Instagram para análise de melhores horários';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $accountId = config('services.instagram.account_id');
        $accessToken = config('services.instagram.access_token');
        $graphUrl = rtrim(config('services.instagram.graph_url'), '/');
        $mediaFields = config('services.instagram.media_fields', 'id,caption,media_type,permalink,timestamp');
        $mediaMetrics = array_filter(array_map('trim', explode(',', (string) config('services.instagram.media_metrics', 'reach,views,likes,comments,shares,saves,total_interactions'))));

        if (empty($accountId) || empty($accessToken)) {
            $this->error('Defina INSTAGRAM_IG_USER_ID e INSTAGRAM_ACCESS_TOKEN antes de executar a sincronização.');
            return 1;
        }

        $days = max(1, (int) $this->option('days'));
        $limit = max(1, min(200, (int) $this->option('limit')));
        $sinceDate = Carbon::now()->subDays($days)->startOfDay();

        $client = new Client([
            'base_uri' => $graphUrl . '/',
            'timeout' => 30,
        ]);

        $this->info(sprintf('Coletando publicacoes dos ultimos %d dias (limite %d).', $days, $limit));
        $mediaItems = $this->fetchMediaItems($client, $accountId, $accessToken, $mediaFields, $limit, $sinceDate);

        if (empty($mediaItems)) {
            $this->warn('Nenhuma publicacao encontrada para o periodo informado.');
            return 0;
        }

        $processed = 0;

        foreach ($mediaItems as $media) {
            $mediaId = Arr::get($media, 'id');

            if (empty($mediaId)) {
                continue;
            }

            try {
                $insights = $this->fetchMediaInsights($client, $mediaId, $accessToken, $mediaMetrics);
                $publishedAt = Arr::get($media, 'timestamp') ? Carbon::parse(Arr::get($media, 'timestamp')) : null;

                InstagramMediaMetric::updateOrCreate(
                    [
                        'instagram_account_id' => $accountId,
                        'media_id' => $mediaId,
                    ],
                    [
                        'media_type' => Arr::get($media, 'media_type'),
                        'caption' => Arr::get($media, 'caption'),
                        'permalink' => Arr::get($media, 'permalink'),
                        'published_at' => $publishedAt,
                        'published_hour' => $publishedAt ? (int) $publishedAt->format('G') : null,
                        'published_weekday' => $publishedAt ? (int) $publishedAt->dayOfWeekIso : null,
                        'reach' => Arr::get($insights, 'reach'),
                        'views' => Arr::get($insights, 'views'),
                        'likes' => Arr::get($insights, 'likes'),
                        'comments' => Arr::get($insights, 'comments'),
                        'shares' => Arr::get($insights, 'shares'),
                        'saves' => Arr::get($insights, 'saves'),
                        'total_interactions' => Arr::get($insights, 'total_interactions'),
                        'raw_payload' => json_encode([
                            'media' => $media,
                            'insights' => Arr::get($insights, 'raw', []),
                        ]),
                    ]
                );

                $processed++;
            } catch (\Throwable $exception) {
                $this->warn(sprintf('Falha ao coletar insights do media %s: %s', $mediaId, $exception->getMessage()));
            }
        }

        $this->info(sprintf('Sincronizacao concluida. %d publicacao(oes) processada(s).', $processed));

        return 0;
    }

    /**
     * @param Client $client
     * @param string $accountId
     * @param string $accessToken
     * @param string $fields
     * @param int $limit
     * @param Carbon $sinceDate
     * @return array
     */
    private function fetchMediaItems(Client $client, $accountId, $accessToken, $fields, $limit, Carbon $sinceDate)
    {
        $items = [];
        $after = null;

        while (count($items) < $limit) {
            $query = [
                'fields' => $fields,
                'limit' => min(50, $limit),
                'access_token' => $accessToken,
            ];

            if (!empty($after)) {
                $query['after'] = $after;
            }

            $response = $client->get($accountId . '/media', [
                'query' => $query,
            ]);

            $payload = json_decode($response->getBody()->getContents(), true);
            $batch = (array) Arr::get($payload, 'data', []);

            if (empty($batch)) {
                break;
            }

            foreach ($batch as $media) {
                $publishedAt = Arr::get($media, 'timestamp') ? Carbon::parse(Arr::get($media, 'timestamp')) : null;

                if ($publishedAt && $publishedAt->lt($sinceDate)) {
                    return $items;
                }

                $items[] = $media;

                if (count($items) >= $limit) {
                    return $items;
                }
            }

            $after = Arr::get($payload, 'paging.cursors.after');
            if (empty($after)) {
                break;
            }
        }

        return $items;
    }

    /**
     * @param Client $client
     * @param string $mediaId
     * @param string $accessToken
     * @param array $metrics
     * @return array
     */
    private function fetchMediaInsights(Client $client, $mediaId, $accessToken, array $metrics)
    {
        $result = [
            'reach' => null,
            'views' => null,
            'likes' => null,
            'comments' => null,
            'shares' => null,
            'saves' => null,
            'total_interactions' => null,
            'raw' => [],
        ];

        foreach ($metrics as $metric) {
            try {
                $response = $client->get($mediaId . '/insights', [
                    'query' => [
                        'metric' => $metric,
                        'access_token' => $accessToken,
                    ],
                ]);

                $payload = json_decode($response->getBody()->getContents(), true);
                $result['raw'][$metric] = $payload;

                $first = Arr::get($payload, 'data.0', []);
                $value = $this->extractMetricValue($first);

                if (array_key_exists($metric, $result) && is_numeric($value)) {
                    $result[$metric] = (int) $value;
                }
            } catch (\Throwable $exception) {
                $result['raw'][$metric] = [
                    'error' => $exception->getMessage(),
                ];
            }
        }

        return $result;
    }

    /**
     * @param array $metric
     * @return mixed|null
     */
    private function extractMetricValue(array $metric)
    {
        $value = Arr::get($metric, 'values.0.value');

        if ($value !== null) {
            return $value;
        }

        $totalValue = Arr::get($metric, 'total_value');

        if (is_array($totalValue)) {
            $nested = Arr::get($totalValue, 'value');
            if ($nested !== null) {
                return $nested;
            }
        }

        return $totalValue;
    }
}
