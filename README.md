# MM Exchange Rates

[![Latest Version on Packagist](https://img.shields.io/packagist/v/php-junior/mm-exchange-rates.svg?style=flat-square)](https://packagist.org/packages/php-junior/mm-exchange-rates)
[![Total Downloads](https://img.shields.io/packagist/dt/php-junior/mm-exchange-rates.svg?style=flat-square)](https://packagist.org/packages/php-junior/mm-exchange-rates)

MM Exchange Rates Package လေးက [https://forex.cbm.gov.mm](https://forex.cbm.gov.mm) ရဲ့ Data ကို သုံးထားတာပါ

## အသုံးပြုပုံ

``` php
$exchangeRates = new \PhpJunior\ExchangeRates\ExchangeRates();
$exchangeRates->currencies(); // Currencies

$exchangeRates->exchangeRates(['USD', 'EUR']); //နောက်ဆုံး Exchange Rates
$exchangeRates->exchangeRates(['USD', 'EUR'], '2019-01-08'); //သက်ဆိုင်ရာရက် Exchange Rates

$exchangeRates->exchangeRatesBetweenDateRange(['USD', 'AUD'], '2019-12-29', '2020-01-08');

$exchangeRates->convert(100,['USD', 'EUR']); // ဘယ် Currency မှာ မြန်မာငွေ ဘယ်လောက်ရှိလဲ တွက်ရန်
$exchangeRates->convert(100,['USD', 'EUR'], '2019-01-08');
```

## Credits

- [All Contributors](https://github.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
