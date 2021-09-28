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
        'region' => env('AWS_DEFAULT_REGION', 'ap-south-1'),
    ],
    'google' => [
        'client_id' => '567185491714-8a3vvjjk82otrht6pcfvmdir4t08q0p8.apps.googleusercontent.com',
        'client_secret' => 'G9LuAI_QBeTnqanbYQl9GRk6',
        'redirect' => 'https://app.uniqtoday.com/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '3045047035767981',
        'client_secret' => '60bcd62a716a83a323e0893935af53ab',
        'redirect' => 'https://app.uniqtoday.com/auth/facebook/callback',
    ],
];
