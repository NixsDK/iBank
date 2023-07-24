<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class CurrencyService
{
    public function convert(float $amount, string $fromCurrency, string $toCurrency): ?float
    {
        $currencies = $this->getCurrencies();

        if (!array_key_exists($fromCurrency, $currencies) || !array_key_exists($toCurrency, $currencies)) {
            return null;
        }

        $currency = $currencies[$toCurrency];
        $currencyToEur = $currencies[$fromCurrency];
        $amountInEur = $amount * (1 / $currencyToEur->getRate());

        if ($toCurrency == "EUR") {
            return $amountInEur;
        }

        return $amountInEur * $currency->getRate();
    }

    public function getCurrencies(): array
    {
        return Cache::remember('currencies', 3600, function () {
            $client = new Client();

            $response = $client->request('GET', "https://www.latvijasbanka.lv/vk/ecb.xml");
            $records = simplexml_load_string($response->getBody()->getContents());

            $currencies = [];
            foreach ($records->Currencies->Currency as $record) {
                $currencies[(string)$record->ID] = new Currency((string)$record->ID, (float)$record->Rate);
            }
            $currencies["EUR"] = new Currency("EUR", 1);
            return $currencies;
        });
    }
}
