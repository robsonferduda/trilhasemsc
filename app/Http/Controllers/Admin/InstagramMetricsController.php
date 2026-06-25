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

        $snapshots = InstagramMetricSnapshot::query()
            ->when($accountId, function ($query) use ($accountId) {
                return $query->where('instagram_account_id', $accountId);
            })
            ->whereBetween('metric_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('metric_date', 'desc')
            ->get();

        $latest = $snapshots->first();

        $totalReach = (int) $snapshots->sum('reach');
        $hasViews = $snapshots->whereNotNull('views')->isNotEmpty();
        $totalViews = $hasViews ? (int) $snapshots->sum('views') : null;

        $profileViewsAvgRaw = $snapshots->whereNotNull('profile_views')->avg('profile_views');
        $avgProfileViews = $profileViewsAvgRaw !== null ? (int) round($profileViewsAvgRaw) : null;

        $websiteClicksAvgRaw = $snapshots->whereNotNull('website_clicks')->avg('website_clicks');
        $avgWebsiteClicks = $websiteClicksAvgRaw !== null ? (int) round($websiteClicksAvgRaw) : null;

        return view('admin.instagram-metrics', compact(
            'days',
            'accountId',
            'snapshots',
            'latest',
            'totalReach',
            'totalViews',
            'avgProfileViews',
            'avgWebsiteClicks'
        ));
    }
}
