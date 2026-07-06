<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramMetricSnapshot extends Model
{
    protected $connection = 'instagram_pgsql';

    protected $table = 'instagram_metric_snapshots';

    protected $fillable = [
        'instagram_account_id',
        'metric_date',
        'followers_count',
        'reach',
        'views',
        'impressions',
        'profile_views',
        'website_clicks',
        'raw_payload',
    ];

    protected $casts = [
        'metric_date' => 'date:Y-m-d',
        'followers_count' => 'integer',
        'reach' => 'integer',
        'views' => 'integer',
        'impressions' => 'integer',
        'profile_views' => 'integer',
        'website_clicks' => 'integer',
    ];
}
