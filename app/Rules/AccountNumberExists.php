<?php

namespace App\Rules;

use App\Models\BankAccount;
use App\Models\InvestmentAccount;
use Illuminate\Contracts\Validation\Rule;

class AccountNumberExists implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value): bool
    {
        return BankAccount::where('account_number', $value)->exists() ||
            InvestmentAccount::where('account_number', $value)->exists();
    }

    public function message(): string
    {
        return 'The :attribute is invalid.';
    }
}
