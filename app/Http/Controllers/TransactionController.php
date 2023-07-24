<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\BankAccount;
use App\Models\InvestmentAccount;
use App\Models\Transaction;
use App\Services\CurrencyService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{

    public function create(): View
    {
        if (auth()->user()->bankAccounts->isEmpty() && auth()->user()->investmentAccounts->isEmpty()) {
            redirect()->back()->withErrors('You need to have at least one bank account or investment account to be able to make transactions.');
        }
        return view('transactions.create', [
            'bankAccounts' => BankAccount::where('user_id', auth()->id())->get(),
            'investmentAccounts' => InvestmentAccount::where('user_id', auth()->id())->get()
        ]);
    }

    public function store(TransactionRequest $request, CurrencyService $currencyService): RedirectResponse
    {

        $senderAccountId = $request->input('sender_account_id');
        $receiverAccountNumber = $request->input('receiver_account_number');


        $senderAccount = BankAccount::find($senderAccountId) ?? InvestmentAccount::find($senderAccountId);
        $receiverAccount = BankAccount::where('account_number', $receiverAccountNumber)->first() ??
            InvestmentAccount::where('account_number', $receiverAccountNumber)->first();

        if ($senderAccount == $receiverAccount) {
            return redirect()->back()->withErrors('You cannot transfer money to the same account.');
        }

        $amount = $request->input('amount');
        $amountForDeposit = $request->input('amount');

        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey(auth()->user()->otp_secret, request('secret'));
        if (!$valid) {
            return redirect()->back()->withErrors('Transaction failed');
        }

        if ($senderAccount && $senderAccount->balance >= $amount) {

            if ($senderAccount->currency != $receiverAccount->currency) {
                $amountForDeposit = $currencyService->convert($amount, $senderAccount->currency, $receiverAccount->currency);
            }

            $senderAccount->withdraw($amount);
            $receiverAccount->deposit($amountForDeposit);

            if ($receiverAccount instanceof InvestmentAccount || $senderAccount instanceof InvestmentAccount) {
                if ($receiverAccount->user_id != $senderAccount->user_id) {
                    return redirect()->back()->withErrors('You are only allowed to transfer money from your investment account to your personal bank accounts.');
                }
                return redirect()->to('/investment-account')->with('success', 'Transaction completed successfully.');
            }

            $transaction = Transaction::create([
                'sender_account_id' => $senderAccount->id,
                'receiver_account_id' => $receiverAccount->id,
                'amount' => $amountForDeposit,
                'currency' => $receiverAccount->currency,
                'description' => $request->input('description'),
                'completed_at' => Carbon::now()
            ]);
            return redirect()->to('/transactions/' . $transaction->id)->with('success', 'Transaction completed successfully.');
        }

        return redirect()->back()->withErrors(['transaction' => 'Transaction failed. Insufficient funds.']);
    }


    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        $userBankAccountIds = auth()->user()->bankAccounts()->pluck('id')->toArray();

        if (!in_array($transaction->sender_account_id, $userBankAccountIds) && !in_array($transaction->receiver_account_id, $userBankAccountIds)) {
            return redirect()->back()->withErrors(['transaction' => 'You are not authorized to view this transaction.']);
        }

        return view('transactions.show', compact('transaction'));
    }
}
