<?php

namespace App;

class ExchangeRate
{
    const url = "https://api.exchangeratesapi.io/latest?base=";
    const currencies = ["CAD","HKD","ISK","PHP","DKK","HUF","CZK","GBP","RON","SEK","IDR","INR","BRL","RUB","HRK",
        "JPY","THB","CHF","EUR","MYR","BGN","TRY","CNY","NOK","NZD","ZAR","USD","MXN","SGD","AUD","ILS","KRW","PLN"];

    private function fetchRates($baseCurrency)
    {
        return json_decode(file_get_contents(self::url . $baseCurrency), true)['rates'];
    }

    public function getRates()
    {
        return \Cache::remember('exchangeRates', 3600, function () {
            $rates = [];
            foreach (self::currencies as $currency) {
                $rates[$currency] = self::fetchRates($currency);
            }
            return $rates;
        });
    }
}
