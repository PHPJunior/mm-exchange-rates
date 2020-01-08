<?php

namespace PhpJunior\MmExchangeRates;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PhpJunior\MmExchangeRates\Skeleton\SkeletonClass
 */
class MmExchangeRatesFacade extends Facade
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
