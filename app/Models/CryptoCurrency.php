<?php

namespace App\Models;

class CryptoCurrency
{
    public $id;
    public $name;
    public $symbol;
    public $date_added;
    public $circulating_supply;
    public $cmc_rank;
    public $price_usd;

    public function __construct(int $id, string $name, string $symbol, string $date_added, int $circulating_supply, int $cmc_rank, float $price_usd)
    {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->date_added = $date_added;
        $this->circulating_supply = $circulating_supply;
        $this->cmc_rank = $cmc_rank;
        $this->price_usd = $price_usd;
    }
}
