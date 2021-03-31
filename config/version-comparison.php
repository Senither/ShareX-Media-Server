<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Version Tracking ID
    |--------------------------------------------------------------------------
    |
    | The unique ID for the project that the latest git commit SHA
    | should be compared with via the API, this can be found on
    | the version tracker when selecting the project.
    |
    | @url https://vt.senither.com/dashboard
    */

    'id' => 'sharex-media-server',

    /*
    |--------------------------------------------------------------------------
    | Cache Expiration Times
    |--------------------------------------------------------------------------
    |
    | The amount of time in seconds that should elapse before
    | the current commit hash is refreshed, or the latest
    | version is fetched from the API.
    |
    */

    'cache_time' => [
        'version' => 7200,
        'commit_hash' => 3600,
    ],
];
