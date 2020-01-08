<?php


namespace PhpJunior\ExchangeRates;


class Currency
{
    public $allowableCurrencies = [
        'USD',
        'CAD',
        'GBP',
        'SEK',
        'NOK',
        'ILS',
        'DKK',
        'AUD',
        'RUB',
        'KWD',
        'INR',
        'BND',
        'EUR',
        'NPR',
        'ZAR',
        'CNY',
        'CHF',
        'THB',
        'PKR',
        'KES',
        'BDT',
        'EGP',
        'SAR',
        'LAK',
        'IDR',
        'KHR',
        'SGD',
        'NZD',
        'LKR',
        'CZK',
        'JPY',
        'VND',
        'PHP',
        'KRW',
        'HKD',
        'BRL',
        'RSD',
        'MYR',
        'MMK'
    ];

    /**
     * @param string $currency
     * @return bool
     */
    public function isAllowableCurrency(string $currency): bool
    {
        return in_array($currency, $this->allowableCurrencies);
    }
}
