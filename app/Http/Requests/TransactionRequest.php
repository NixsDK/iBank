<?php

namespace App\Http\Requests;

use App\Rules\AccountNumberExists;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'receiver_account_number' => [
                'required',
                new AccountNumberExists
            ],
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
            'secret' => 'required|numeric|digits:6',
        ];
    }
}
