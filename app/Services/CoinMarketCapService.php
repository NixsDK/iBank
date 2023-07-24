<?php

namespace App\Services;

use App\Models\CryptoCurrency;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class CoinMarketCapService
{
    private $client;

    public function __construct()
    {
        $api_key = config('services.coinmarketcap.api_key');

        $this->client = new Client([
            'base_uri' => 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/',
            'headers' => [
                'X-CMC_PRO_API_KEY' => $api_key,
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function getCryptoInfo(): ?array
    {
        return Cache::remember('crypto_info', 3600, function () {
            $cryptoData = $this->fetch();
            if (!empty($cryptoData)) {
                $cryptoCurrencies = [];
                foreach ($cryptoData->data as $currency) {
                    $cryptoCurrencies[] = new CryptoCurrency(
                        $currency->id,
                        $currency->name,
                        $currency->symbol,
                        $currency->date_added,
                        $currency->circulating_supply,
                        $currency->cmc_rank,
                        $currency->quote->USD->price
                    );
                }
                return $cryptoCurrencies;
            }
            return null;
        });
    }

    public function findById($cryptoCurrencyId): ?CryptoCurrency
    {
        return Cache::remember('crypto_info_' . $cryptoCurrencyId, 3600, function () use ($cryptoCurrencyId) {
            $cryptoData = $this->fetch($cryptoCurrencyId);
            if (!empty($cryptoData)) {
                $currency = $cryptoData->data;
                return new CryptoCurrency(
                    $currency->{$cryptoCurrencyId}->id,
                    $currency->{$cryptoCurrencyId}->name,
                    $currency->{$cryptoCurrencyId}->symbol,
                    $currency->{$cryptoCurrencyId}->date_added,
                    $currency->{$cryptoCurrencyId}->circulating_supply,
                    $currency->{$cryptoCurrencyId}->cmc_rank,
                    $currency->{$cryptoCurrencyId}->quote->USD->price
                );
            }
            return null;
        });
    }

    private function fetch($cryptoCurrencyId = null): ?\stdClass
    {
        try {
            $queryParams = [
                'convert' => 'USD'
            ];

            if ($cryptoCurrencyId !== null) {
                $queryParams['id'] = $cryptoCurrencyId;
            }

            $endpoint = $cryptoCurrencyId !== null ? 'quotes/latest' : 'listings/latest';

            $response = $this->client->request('GET', $endpoint, [
                'query' => $queryParams
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (GuzzleException $e) {
            $e->getMessage();
        }

        return null;
    }
}
