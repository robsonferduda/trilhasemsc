<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('APP_URL').'/login/facebook/callback',
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('APP_URL').'/login/google/callback',
    ],

    'instagram' => [
        'graph_url' => env('INSTAGRAM_GRAPH_URL', 'https://graph.facebook.com/v20.0'),
        'access_token' => env('INSTAGRAM_ACCESS_TOKEN'),
        'account_id' => env('INSTAGRAM_IG_USER_ID'),
        'metrics' => env('INSTAGRAM_DAILY_METRICS', 'reach,views,profile_views,website_clicks,follower_count'),
        'media_fields' => env('INSTAGRAM_MEDIA_FIELDS', 'id,caption,media_type,permalink,timestamp'),
        'media_metrics' => env('INSTAGRAM_MEDIA_METRICS', 'reach,views,likes,comments,shares,saves,total_interactions'),
        'score_weights' => [
            'reach' => env('INSTAGRAM_SCORE_WEIGHT_REACH', 1),
            'views' => env('INSTAGRAM_SCORE_WEIGHT_VIEWS', 0.5),
            'profile_views' => env('INSTAGRAM_SCORE_WEIGHT_PROFILE_VIEWS', 5),
            'website_clicks' => env('INSTAGRAM_SCORE_WEIGHT_WEBSITE_CLICKS', 20),
        ],
    ],

];
