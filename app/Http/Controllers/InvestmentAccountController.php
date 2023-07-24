<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyCryptoAssetRequest;
use App\Http\Requests\SellCryptoAssetRequest;
use App\Models\InvestmentAccount;
use App\Models\User;
use App\Services\CoinMarketCapService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvestmentAccountController extends Controller
{
    public function index(): View
    {
        $investmentAccount = User::find(auth()->id())->investmentAccounts->first();

        return view('investmentAccount.index', compact('investmentAccount'));
    }

    public function store(): RedirectResponse
    {

        InvestmentAccount::create([
            'account_number' => $this->generateBankAccountNumber(),
            'user_id' => auth()->id(),
            'balance' => 100000,
            'currency' => 'USD'
        ]);

        return redirect()->back()->with('success', 'Your Investment account has been created.');
    }

    public function show(InvestmentAccount $investmentAccount)
    {
        if ($investmentAccount->user_id != auth()->id()) {
            return redirect()->back()->withErrors('You are not allowed to see this account.');
        }

        $currentAssets = $investmentAccount->cryptoAssets()
            ->select('symbol',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('AVG(purchase_price) as average_price'))
            ->groupBy('symbol')
            ->get();

        return view('investmentAccount.show', compact('investmentAccount', 'currentAssets'));
    }

    public function destroy(InvestmentAccount $investmentAccount): RedirectResponse
    {
        if ($investmentAccount->user_id != auth()->id()) {
            return redirect()->back()->withErrors('You are not allowed to delete this account.');
        }

        if ($investmentAccount->balance > 0) {
            return redirect()->back()->withErrors('You cannot delete an account with balance.');
        }

        $investmentAccount->delete();

        return redirect('/investment-account')->with('success', 'Your Investment account has been deleted.');
    }

    public function showBuyCryptoAssetForm(InvestmentAccount $investmentAccount)
    {
        if ($investmentAccount->user_id != auth()->id()) {
            return redirect()->back();
        }

        $cryptoCurrencies = (new CoinMarketCapService)->getCryptoInfo();

        if ($cryptoCurrencies === null) {
            redirect()->back()->withErrors('Something went wrong. Please try again later.');
        }

        return view('investmentAccount.buyCryptoAsset',
            compact('investmentAccount', 'cryptoCurrencies'));
    }

    public function buyCryptoAsset(BuyCryptoAssetRequest $request, InvestmentAccount $investmentAccount): RedirectResponse
    {
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey(auth()->user()->otp_secret, $request->input('secret'));

        if (!$valid) {
            return redirect()->back()->withErrors('Action ended. Wrong code.');
        }

        $cryptoCurrencyId = $request->input('crypto_currency_id');
        $quantity = $request->input('quantity');

        $result = $investmentAccount->buyCryptoAsset($cryptoCurrencyId, $quantity);

        if ($result === false) {
            return redirect()->back()->withErrors('Insufficient funds or something went wrong.');
        }

        return redirect()->back()->with('success', 'Your purchase was successful.');
    }

    public function showSellCryptoAssetForm(InvestmentAccount $investmentAccount)
    {
        if ($investmentAccount->user_id != auth()->id()) {
            return redirect()->back();
        }

        $currentAssets = $investmentAccount->cryptoAssets()
            ->select('symbol',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('AVG(purchase_price) as average_price'))
            ->groupBy('symbol')
            ->get();

        $cryptoAssets = $investmentAccount->cryptoAssets()->get();

        return view('investmentAccount.sellCryptoAsset',
            compact('investmentAccount', 'currentAssets', 'cryptoAssets'));
    }

    public function sellCryptoAsset(SellCryptoAssetRequest $request, InvestmentAccount $investmentAccount): RedirectResponse
    {
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey(auth()->user()->otp_secret, $request->input('secret'));

        if (!$valid) {
            return redirect()->back()->withErrors('Action ended. Wrong code.');
        }

        $cryptoAssetId = $request->input('crypto_asset_id');
        $quantity = $request->input('quantity');

        $result = $investmentAccount->sellCryptoAsset($cryptoAssetId, $quantity);

        if ($result === false) {
            return redirect()->back()->withErrors('Insufficient funds or wrong quantity.');
        }

        return redirect()->back()->with('success', 'Your sale was successful. You have received ' . $result . ' USD.');
    }

    private function generateBankAccountNumber(): string
    {
        $randomNumber = mt_rand(10000000, 99999999);
        return 'LV55INVE' . $randomNumber;
    }
}
