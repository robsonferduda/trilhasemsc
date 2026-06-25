<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'avgWebsiteClicks'
        ) + ['comparison' => $comparison]);
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
