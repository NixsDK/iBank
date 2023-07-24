<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountRequest;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\User;
use App\Services\CurrencyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BankAccountController extends Controller
{
    public function index(): View
    {
        $bankAccounts = User::find(auth()->id())->bankAccounts;

        return view('bankAccount.index', compact('bankAccounts'));
    }

    public function create(CurrencyService $currencyService): View
    {
        $currencies = $currencyService->getCurrencies();

        if (empty($currencies)) {
            redirect('/accounts')->withErrors('Something went wrong. Please try again later.');
        }

        return view('bankAccount.create', [
            'currencies' => $currencies
        ]);
    }

    public function store(BankAccountRequest $request): RedirectResponse
    {
        BankAccount::create([
            'user_id' => auth()->id(),
            'account_number' => $this->generateBankAccountNumber(),
            'balance' => 100000,
            'currency' => $request->input('currency')
        ]);

        return redirect('/accounts')->with('success', 'Your Bank account has been created.');
    }

    public function show(BankAccount $bankAccount)
    {
        if ($bankAccount->user_id != auth()->id()) {
            return redirect('/accounts')->withErrors('You are not authorized to view this account.');
        }

        $transactions = Transaction::where('sender_account_id', $bankAccount->id)
            ->orWhere('receiver_account_id', $bankAccount->id)
            ->orderBy('completed_at', 'desc')
            ->paginate(30);

        return view('bankAccount.show', compact('bankAccount', 'transactions'));
    }


    public function destroy(BankAccount $bankAccount): RedirectResponse
    {
        if ($bankAccount->balance != 0) {
            return redirect('/accounts')->withErrors('You cannot delete an account with a balance.');
        }

        $bankAccount->delete();

        return redirect('/accounts')->with('success', 'Your Bank account has been deleted.');
    }

    private function generateBankAccountNumber(): string
    {
        $randomNumber = mt_rand(10000000, 99999999);
        return 'LV55GUVA' . $randomNumber;
    }
}
