<?php

return [
    'enabled' => env('MM_EXCHANGE_RATES_CACHE_ENABLED', true),
    'cache_lifetime_in_minutes' => env('MM_EXCHANGE_RATES_CACHE_LIFETIME', 900),
    'cache_key' => 'mmexchangerates'
];
