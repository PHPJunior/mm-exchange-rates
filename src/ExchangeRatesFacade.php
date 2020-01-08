<?php

namespace PhpJunior\ExchangeRates;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PhpJunior\ExchangeRates\Skeleton\SkeletonClass
 */
class ExchangeRatesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mm-exchange-rates';
    }
}
