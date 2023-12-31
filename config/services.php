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
        'scheme' => 'https',
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
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_CALLBACK'),
    ],
    'instagram' => [
        'client_id' => env('INSTAGRAM_APP_ID'),
        'client_secret' => env('INSTAGRAM_APP_SECRET'),
        'redirect' => env('INSTAGRAM_CALLBACK'),
    ],

    
    'instagrambasic' => [
        'client_id' => env('INSTAGRAM_APP_ID'),
        'client_secret' => env('INSTAGRAM_APP_SECRET'),
        'redirect' => env('INSTAGRAM_CALLBACK_URL'),
    ],

    'twitter' => [    
        'client_id' => env('X_CLIENT_ID'),  
        'client_secret' => env('X_CLIENT_SECRET'),  
        'redirect' => env('X_CALLBACK') 
      ],

      
    'linkedin' => [    
        'client_id' => env('LINKEDIN_ID'),  
        'client_secret' => env('LINKEDIN_SECRET'),  
        'redirect' => env('LINKEDIN_CALLBACK_URL') 
      ],
];
