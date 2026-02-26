<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Passport Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify which authentication guard Passport will use when
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your "auth" configuration file.
    |
    */

    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Encryption Keys
    |--------------------------------------------------------------------------
    |
    | Passport uses encryption keys while generating secure access tokens for
    | your application. By default, the keys are stored as local files but
    | can be set via environment variables when that is more convenient.
    |
    */

    'private_key' => env('PASSPORT_PRIVATE_KEY'),

    'public_key' => env('PASSPORT_PUBLIC_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Passport Database Connection
    |--------------------------------------------------------------------------
    |
    | By default, Passport's models will utilize your application's default
    | database connection. If you wish to use a different connection you
    | may specify the configured name of the database connection here.
    |
    */

    'connection' => env('PASSPORT_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Trusted Internal Clients
    |--------------------------------------------------------------------------
    |
    | These clients will skip the consent screen after the first successful
    | authorization grant. Add client IDs or client names from oauth_clients.
    |
    */

    'auto_approve_trusted_clients' => env('PASSPORT_AUTO_APPROVE_TRUSTED_CLIENTS', true),

    'trusted_client_ids' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('PASSPORT_TRUSTED_CLIENT_IDS', ''))
    ))),

    'trusted_client_names' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('PASSPORT_TRUSTED_CLIENT_NAMES', 'foodpanda-app'))
    ))),

];
