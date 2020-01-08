<?php

namespace PhpJunior\ExchangeRates;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class ExchangeRates
{
    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    /**
     * ExchangeRates constructor.
     * @param RequestBuilder $requestBuilder
     */
    public function __construct(
        RequestBuilder $requestBuilder = null
    )
    {
        $this->requestBuilder = $requestBuilder ?? new RequestBuilder(new Client());
    }

    /**
     * @return mixed
     */
    public function currencies()
    {
        $response = $this->requestBuilder->makeRequest('/currencies');
        return $response['currencies'];
    }

    public function exchangeRatesBetweenDateRange(array $currencies, $from, $to)
    {
        $data = [];
        $period = CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            $data[$date->format('Y-m-d')] = $this->exchangeRates($currencies, $date->format('Y-m-d'));
        }
        return $data;
    }

    /**
     * @param array $currencies
     * @param $date
     * @return array
     * @throws InvalidCurrencyException
     * @throws InvalidDateException
     */
    public function exchangeRates(array $currencies, $date = null)
    {
        foreach ($currencies as $currency)
        {
            Validation::validateCurrencyCode($currency);
        }

        if ($date) {
            Validation::validateDate(Carbon::parse($date));
            $date = Carbon::parse($date)->format('d-m-Y');
        }

        if (config('mm-exchange-rates.enabled'))
            return cache()->remember($this->buildCacheKey($currencies, $date), config('mm-exchange-rates.cache_lifetime_in_minutes'), function () use ($currencies, $date) {
                return $this->getExchangeRates($currencies, $date);
            });

        return $this->getExchangeRates($currencies, $date);
    }

    /**
     * @param int $value
     * @param array $currencies
     * @param $date
     * @return array
     * @throws InvalidCurrencyException
     * @throws InvalidDateException
     */
    public function convert(int $value, array $currencies, $date = null)
    {
        $collection = collect($this->exchangeRates($currencies, $date));
        $data = $collection->map(function ($item, $key) use ($value){
            return $item * $value;
        });
        return $data->all();
    }

    /**
     * @param $currencies
     * @param null $date
     * @return array
     */
    private function getExchangeRates($currencies, $date = null)
    {
        $exchangeRate = $date ? $this->requestBuilder->makeRequest('/history/' . $date) : $this->requestBuilder->makeRequest('/latest');
        $rates = Arr::only($exchangeRate['rates'], $currencies);
        $collection = collect($rates);
        $data = $collection->map(function ($item, $key){
            return intval(str_replace(',','', $item));
        });

        return $data->all();
    }

    /**
     * @param $currencies
     * @param $date
     * @return string
     */
    private function buildCacheKey($currencies, $date)
    {
        return config('mm-exchange-rates.cache_key').'-'.implode('-', $currencies).'-'.$date;
    }
}
