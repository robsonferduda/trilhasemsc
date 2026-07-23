<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramMediaMetric extends Model
{
    protected $table = 'instagram_media_metrics';

    protected $fillable = [
        'instagram_account_id',
        'media_id',
        'media_type',
        'caption',
        'permalink',
        'published_at',
        'published_hour',
        'published_weekday',
        'reach',
        'views',
        'likes',
        'comments',
        'shares',
        'saves',
        'total_interactions',
        'raw_payload',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'published_hour' => 'integer',
        'published_weekday' => 'integer',
        'reach' => 'integer',
        'views' => 'integer',
        'likes' => 'integer',
        'comments' => 'integer',
        'shares' => 'integer',
        'saves' => 'integer',
        'total_interactions' => 'integer',
    ];
}
