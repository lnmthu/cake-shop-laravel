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
        'client_id' => '178027310118744',  //client face của bạn
        'client_secret' => '125fffa5cb0fddd411dfb2fc553355fd',  //client app service face của bạn
        'redirect' => 'http://localhost/LaravelSell/public/login/callbackFacebook' //callback trả về
    ],

    'google' => [
        'client_id' => '385350906620-9olq9jcbub9ndf54tqal5tb4hpv839gt.apps.googleusercontent.com',
        'client_secret' => '99fcPo0fM-b8P7AqozNeJ6x4',
        'redirect' => 'http://localhost/LaravelSell/public/login/callbackGoogle' 
    ],

];
