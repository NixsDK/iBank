<?php

namespace App\Models;

use App\Services\CoinMarketCapService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvestmentAccount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function cryptoAssets(): HasMany
    {
        return $this->hasMany(CryptoAsset::class);
    }

    public function deposit($amount): void
    {
        $this->balance += $amount;
        $this->save();
    }

    public function withdraw($amount): bool
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $this->save();
            return true;
        }
        return false;
    }

    public function buyCryptoAsset(int $cryptoCurrencyId, float $quantity)
    {
        $cryptoCurrency = (new CoinMarketCapService)->findById($cryptoCurrencyId);

        if (!$cryptoCurrency) {
            return false;
        }

        $totalCost = $cryptoCurrency->price_usd * $quantity;

        if ($this->balance < $totalCost) {
            return false;
        }

        $cryptoAsset = CryptoAsset::create([
            'investment_account_id' => $this->id,
            'crypto_currency_id' => $cryptoCurrency->id,
            'name' => $cryptoCurrency->name,
            'symbol' => $cryptoCurrency->symbol,
            'quantity' => $quantity,
            'purchase_price' => $cryptoCurrency->price_usd,
        ]);

        $this->balance -= $totalCost;
        $this->save();

        return $cryptoAsset;
    }

    public function sellCryptoAsset(int $cryptoAssetId, float $quantity)
    {

        $cryptoAsset = CryptoAsset::find($cryptoAssetId);


        if (!$cryptoAsset || $cryptoAsset->quantity < $quantity){
            return false;
        }

        $cryptoCurrency = (new CoinMarketCapService)->findById($cryptoAsset->crypto_currency_id);


        if (!$cryptoCurrency) {
            return false;
        }


        $totalValue = $cryptoCurrency->price_usd * $quantity;


        if($cryptoAsset->quantity == $quantity) {
            $cryptoAsset->delete();
        }

        if($cryptoAsset->quantity > $quantity) {
            $cryptoAsset->quantity -= $quantity;
            $cryptoAsset->save();
        }


        $this->balance += $totalValue;
        $this->save();

        return $totalValue;
    }
}
