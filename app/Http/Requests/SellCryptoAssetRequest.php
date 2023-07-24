<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellCryptoAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'crypto_asset_id' => 'required|integer',
            'quantity' => 'required|numeric|min:0',
            'secret' => 'required|numeric|digits:6',
        ];
    }
}
