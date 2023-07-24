<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyCryptoAssetRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'crypto_currency_id' => 'required|integer',
            'quantity' => 'required|numeric|min:0',
            'secret' => 'required|numeric|digits:6',
        ];
    }
}
