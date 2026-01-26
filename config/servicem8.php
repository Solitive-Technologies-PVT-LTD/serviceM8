<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ServiceM8 API Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for connecting to the
    | ServiceM8 API using an x-api-key.
    |
    | Docs: https://developer.servicem8.com
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Base API URL
    |--------------------------------------------------------------------------
    |
    | Default ServiceM8 API base URL.
    |
    */
    'base_url' => env('SERVICEM8_BASE_URL', 'https://api.servicem8.com/api_1.0'),

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Your ServiceM8 API key.
    | Example: sk_live_xxxxxxxxxxxxxxxxx
    |
    */
    'api_key' => env('SERVICEM8_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Default Request Headers
    |--------------------------------------------------------------------------
    |
    | Headers automatically sent with every request.
    |
    */
    'headers' => [
        'Accept' => 'application/json',
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination Defaults
    |--------------------------------------------------------------------------
    |
    | ServiceM8 uses offset & limit style pagination.
    |
    */
    'pagination' => [
        'limit' => 100,
    ],

    /*
    |--------------------------------------------------------------------------
    | Sync Options
    |--------------------------------------------------------------------------
    |
    | Control how ServiceM8 data syncs into your system.
    |
    */
    'sync' => [

        // Automatically create folders for jobs
        'auto_create_job_folders' => true,

        // Automatically download attachments
        'download_attachments' => true,

        // Storage disk for downloaded attachments
        'storage_disk' => 'local',

        // Base folder where ServiceM8 documents will be stored
        'storage_path' => 'documents/servicem8',
    ],

    /*
    |--------------------------------------------------------------------------
    | Folder Naming Conventions
    |--------------------------------------------------------------------------
    |
    | These are used when mapping ServiceM8 data to your document system.
    |
    */
    'folders' => [
        'clients'      => 'Clients',
        'jobs'         => 'Jobs',
        'quotes'       => 'Quotes',
        'invoices'     => 'Invoices',
        'attachments'  => 'Attachments',
        'reports'      => 'Reports',
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Enable logging of API calls & errors.
    |
    */
    'logging' => [
        'enabled' => env('SERVICEM8_LOGGING', true),
        'channel' => env('SERVICEM8_LOG_CHANNEL', 'stack'),
    ],

];
