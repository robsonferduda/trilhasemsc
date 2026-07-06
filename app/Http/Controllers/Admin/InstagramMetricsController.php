<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InstagramMediaMetric;
use App\InstagramMetricSnapshot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstagramMetricsController extends Controller
{
    /**
     * Exibe dashboard inicial de métricas do Instagram.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $days = (int) $request->get('days', 30);
        $days = max(7, min(90, $days));

        $accountId = config('services.instagram.account_id');

        $endDate = Carbon::today();
        $startDate = (clone $endDate)->subDays($days - 1);
        $previousEndDate = (clone $startDate)->subDay();
        $previousStartDate = (clone $previousEndDate)->subDays($days - 1);

        $snapshots = InstagramMetricSnapshot::query()
            ->when($accountId, function ($query) use ($accountId) {
                return $query->where('instagram_account_id', $accountId);
            })
            ->whereBetween('metric_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('metric_date', 'desc')
            ->get();

        $previousSnapshots = InstagramMetricSnapshot::query()
            ->when($accountId, function ($query) use ($accountId) {
                return $query->where('instagram_account_id', $accountId);
            })
            ->whereBetween('metric_date', [$previousStartDate->toDateString(), $previousEndDate->toDateString()])
            ->orderBy('metric_date', 'desc')
            ->get();

        $latest = $snapshots->first();
        $previousLatest = $previousSnapshots->first();

        $totalReach = (int) $snapshots->sum('reach');
        $hasViews = $snapshots->whereNotNull('views')->isNotEmpty();
        $totalViews = $hasViews ? (int) $snapshots->sum('views') : null;

        $profileViewsAvgRaw = $snapshots->whereNotNull('profile_views')->avg('profile_views');
        $avgProfileViews = $profileViewsAvgRaw !== null ? (int) round($profileViewsAvgRaw) : null;

        $websiteClicksAvgRaw = $snapshots->whereNotNull('website_clicks')->avg('website_clicks');
        $avgWebsiteClicks = $websiteClicksAvgRaw !== null ? (int) round($websiteClicksAvgRaw) : null;

        $weights = [
            'reach' => (float) config('services.instagram.score_weights.reach', 1),
            'views' => (float) config('services.instagram.score_weights.views', 0.5),
            'profile_views' => (float) config('services.instagram.score_weights.profile_views', 5),
            'website_clicks' => (float) config('services.instagram.score_weights.website_clicks', 20),
        ];

        $scoreRows = $snapshots->map(function ($snapshot) use ($weights) {
            $score =
                ((int) ($snapshot->reach ?: 0) * $weights['reach']) +
                ((int) ($snapshot->views ?: 0) * $weights['views']) +
                ((int) ($snapshot->profile_views ?: 0) * $weights['profile_views']) +
                ((int) ($snapshot->website_clicks ?: 0) * $weights['website_clicks']);

            return [
                'date' => $snapshot->metric_date,
                'score' => (int) round($score),
                'reach' => $snapshot->reach,
                'views' => $snapshot->views,
                'profile_views' => $snapshot->profile_views,
                'website_clicks' => $snapshot->website_clicks,
            ];
        })->values();

        $scoreAverage = $scoreRows->count() > 0 ? (float) $scoreRows->avg('score') : 0.0;
        $scoreRows = collect($scoreRows)->map(function ($row) use ($scoreAverage) {
            $status = $this->classifyScore($row['score'], $scoreAverage);

            return $row + [
                'status' => $status,
                'recommendation' => $this->buildRecommendation($row, $status),
            ];
        });

        $statusSummary = [
            'above' => $scoreRows->where('status', 'above')->count(),
            'normal' => $scoreRows->where('status', 'normal')->count(),
            'below' => $scoreRows->where('status', 'below')->count(),
        ];

        $latestScore = $scoreRows->first();

        $mediaMetrics = InstagramMediaMetric::query()
            ->when($accountId, function ($query) use ($accountId) {
                return $query->where('instagram_account_id', $accountId);
            })
            ->whereBetween('published_at', [
                (clone $startDate)->startOfDay()->toDateTimeString(),
                (clone $endDate)->endOfDay()->toDateTimeString(),
            ])
            ->whereNotNull('published_hour')
            ->whereNotNull('reach')
            ->get();

        $topHours = $mediaMetrics
            ->groupBy('published_hour')
            ->map(function ($items, $hour) {
                $postsCount = $items->count();
                $totalReachByHour = (int) $items->sum('reach');

                return [
                    'hour' => (int) $hour,
                    'range_label' => sprintf('%02d:00 - %02d:59', (int) $hour, (int) $hour),
                    'posts_count' => $postsCount,
                    'total_reach' => $totalReachByHour,
                    'avg_reach' => $postsCount > 0 ? (int) round($totalReachByHour / $postsCount) : 0,
                ];
            })
            ->sortByDesc('avg_reach')
            ->take(5)
            ->values();

        $bestHour = $topHours->first();

        $comparison = [
            'reach' => $this->buildComparison($snapshots, $previousSnapshots, 'reach'),
            'views' => $this->buildComparison($snapshots, $previousSnapshots, 'views'),
            'profile_views' => $this->buildComparison($snapshots, $previousSnapshots, 'profile_views'),
            'website_clicks' => $this->buildComparison($snapshots, $previousSnapshots, 'website_clicks'),
            'followers_count' => $this->buildFollowerComparison($latest, $previousLatest),
        ];

        return view('admin.instagram-metrics', compact(
            'days',
            'accountId',
            'snapshots',
            'latest',
            'previousLatest',
            'totalReach',
            'totalViews',
            'avgProfileViews',
            'avgWebsiteClicks',
            'scoreRows',
            'scoreAverage',
            'statusSummary',
            'latestScore',
            'topHours',
            'bestHour'
        ) + ['comparison' => $comparison]);
    }

    /**
     * @param int|float $score
     * @param int|float $average
     * @return string
     */
    private function classifyScore($score, $average)
    {
        if ((float) $average <= 0.0) {
            return 'normal';
        }

        $upperLimit = $average * 1.15;
        $lowerLimit = $average * 0.85;

        if ($score >= $upperLimit) {
            return 'above';
        }

        if ($score <= $lowerLimit) {
            return 'below';
        }

        return 'normal';
    }

    /**
     * @param array $row
     * @param string $status
     * @return string
     */
    private function buildRecommendation(array $row, $status)
    {
        if ($status === 'above') {
            return 'Replicar formato/tema deste dia nas proximas publicacoes.';
        }

        if ($status === 'below') {
            if ((int) $row['website_clicks'] === 0) {
                return 'Testar CTA direto para link na bio e reforcar chamada no criativo.';
            }

            return 'Ajustar horario e variar gancho inicial para recuperar alcance.';
        }

        return 'Manter consistencia e testar pequenas variacoes de titulo e CTA.';
    }

    /**
     * @param \Illuminate\Support\Collection $current
     * @param \Illuminate\Support\Collection $previous
     * @param string $field
     * @return array
     */
    private function buildComparison($current, $previous, $field)
    {
        $currentValue = $current->whereNotNull($field)->sum($field);
        $previousValue = $previous->whereNotNull($field)->sum($field);

        return [
            'current' => $currentValue,
            'previous' => $previousValue,
            'delta' => $currentValue - $previousValue,
            'percent' => $this->percentChange($currentValue, $previousValue),
        ];
    }

    /**
     * @param \App\InstagramMetricSnapshot|null $latest
     * @param \App\InstagramMetricSnapshot|null $previousLatest
     * @return array
     */
    private function buildFollowerComparison($latest, $previousLatest)
    {
        $currentValue = $latest ? (int) $latest->followers_count : 0;
        $previousValue = $previousLatest ? (int) $previousLatest->followers_count : 0;

        return [
            'current' => $currentValue,
            'previous' => $previousValue,
            'delta' => $currentValue - $previousValue,
            'percent' => $this->percentChange($currentValue, $previousValue),
        ];
    }

    /**
     * @param int|float $current
     * @param int|float $previous
     * @return float|null
     */
    private function percentChange($current, $previous)
    {
        if ((float) $previous === 0.0) {
            return null;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }
}
