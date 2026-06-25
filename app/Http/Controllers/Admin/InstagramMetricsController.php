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
        $totalImpressions = (int) $snapshots->sum('impressions');
        $avgProfileViews = (int) round($snapshots->avg('profile_views') ?: 0);
        $avgWebsiteClicks = (int) round($snapshots->avg('website_clicks') ?: 0);

        return view('admin.instagram-metrics', compact(
            'days',
            'accountId',
            'snapshots',
            'latest',
            'totalReach',
            'totalImpressions',
            'avgProfileViews',
            'avgWebsiteClicks'
        ));
    }
}
