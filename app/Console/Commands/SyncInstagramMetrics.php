<?php

namespace App\Console\Commands;

use App\InstagramMetricSnapshot;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class SyncInstagramMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:sync-metrics {--date=} {--days=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extrai métricas diárias do Instagram Graph API e salva snapshots no PostgreSQL';

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
        $metrics = config('services.instagram.metrics', 'reach,profile_views,website_clicks,follower_count');

        if (empty($accountId) || empty($accessToken)) {
            $this->error('Defina INSTAGRAM_IG_USER_ID e INSTAGRAM_ACCESS_TOKEN antes de executar a sincronização.');
            return 1;
        }

        $startDate = $this->option('date')
            ? Carbon::parse($this->option('date'))->startOfDay()
            : Carbon::yesterday()->startOfDay();

        $days = (int) $this->option('days');
        if ($days < 1) {
            $days = 1;
        }

        $client = new Client([
            'base_uri' => $graphUrl . '/',
            'timeout' => 30,
        ]);

        $followersCount = $this->fetchFollowersCount($client, $accountId, $accessToken);

        for ($offset = 0; $offset < $days; $offset++) {
            $date = (clone $startDate)->subDays($offset);

            try {
                $dailyData = $this->fetchDailyInsights($client, $accountId, $accessToken, $metrics, $date);

                InstagramMetricSnapshot::updateOrCreate(
                    [
                        'instagram_account_id' => $accountId,
                        'metric_date' => $date->toDateString(),
                    ],
                    [
                        'followers_count' => $followersCount ?: Arr::get($dailyData, 'follower_count'),
                        'reach' => Arr::get($dailyData, 'reach'),
                        'impressions' => Arr::get($dailyData, 'impressions'),
                        'profile_views' => Arr::get($dailyData, 'profile_views'),
                        'website_clicks' => Arr::get($dailyData, 'website_clicks'),
                        'raw_payload' => json_encode($dailyData['raw']),
                    ]
                );

                $this->info(sprintf('Snapshot salvo para %s.', $date->toDateString()));
            } catch (\Throwable $exception) {
                $this->error(sprintf('Falha ao sincronizar %s: %s', $date->toDateString(), $exception->getMessage()));
            }
        }

        return 0;
    }

    /**
     * @param Client $client
     * @param string $accountId
     * @param string $accessToken
     * @return int|null
     */
    private function fetchFollowersCount(Client $client, $accountId, $accessToken)
    {
        try {
            $response = $client->get($accountId, [
                'query' => [
                    'fields' => 'followers_count',
                    'access_token' => $accessToken,
                ],
            ]);

            $payload = json_decode($response->getBody()->getContents(), true);
            return Arr::get($payload, 'followers_count');
        } catch (\Throwable $exception) {
            $this->warn('Nao foi possivel obter followers_count nesta execucao.');
            return null;
        }
    }

    /**
     * @param Client $client
     * @param string $accountId
     * @param string $accessToken
     * @param string $metrics
     * @param Carbon $date
     * @return array
     */
    private function fetchDailyInsights(Client $client, $accountId, $accessToken, $metrics, Carbon $date)
    {
        $requestedMetrics = array_filter(array_map('trim', explode(',', (string) $metrics)));
        $totalValueMetrics = ['profile_views', 'website_clicks'];
        $regularMetrics = array_values(array_diff($requestedMetrics, $totalValueMetrics));
        $specialMetrics = array_values(array_intersect($requestedMetrics, $totalValueMetrics));

        $since = (clone $date)->startOfDay()->timestamp;
        $until = (clone $date)->addDay()->startOfDay()->timestamp;

        $payload = [
            'data' => [],
        ];

        if (!empty($regularMetrics)) {
            $regularPayload = $this->requestInsights(
                $client,
                $accountId,
                $accessToken,
                implode(',', $regularMetrics),
                $since,
                $until
            );

            $payload['data'] = array_merge($payload['data'], (array) Arr::get($regularPayload, 'data', []));
        }

        if (!empty($specialMetrics)) {
            try {
                $specialPayload = $this->requestInsights(
                    $client,
                    $accountId,
                    $accessToken,
                    implode(',', $specialMetrics),
                    $since,
                    $until,
                    ['metric_type' => 'total_value']
                );

                $payload['data'] = array_merge($payload['data'], (array) Arr::get($specialPayload, 'data', []));
            } catch (\Throwable $exception) {
                $this->warn('Nao foi possivel coletar profile_views/website_clicks nesta execucao: ' . $exception->getMessage());
            }
        }

        $result = [
            'raw' => $payload,
            'reach' => null,
            'impressions' => null,
            'profile_views' => null,
            'website_clicks' => null,
            'follower_count' => null,
        ];

        foreach ((array) Arr::get($payload, 'data', []) as $metric) {
            $name = Arr::get($metric, 'name');
            $value = $this->extractMetricValue($metric);

            if (array_key_exists($name, $result)) {
                $result[$name] = is_numeric($value) ? (int) $value : null;
            }
        }

        return $result;
    }

    /**
     * @param Client $client
     * @param string $accountId
     * @param string $accessToken
     * @param string $metrics
     * @param int $since
     * @param int $until
     * @param array $extraQuery
     * @return array
     */
    private function requestInsights(Client $client, $accountId, $accessToken, $metrics, $since, $until, array $extraQuery = [])
    {
        $query = array_merge([
            'metric' => $metrics,
            'period' => 'day',
            'since' => $since,
            'until' => $until,
            'access_token' => $accessToken,
        ], $extraQuery);

        $response = $client->get($accountId . '/insights', [
            'query' => $query,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Extrai valor de métricas em formatos diferentes da API.
     *
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
