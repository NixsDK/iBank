<?php

use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestmentAccountController;
use App\Http\Controllers\TransactionController;
use App\Services\CoinMarketCapService;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth'])->name('home');

Route::get('/security', function () {
    Auth::user()->initial_setup = 0;
    Auth::user()->save();
    return view('security');
})->middleware(['auth'])->name('security');

Route::get('/rates-info', function (CurrencyService $currencyService, CoinMarketCapService $coinMarketCapService) {
    $currencies = $currencyService->getCurrencies();
    $cryptoCurrencies = $coinMarketCapService->getCryptoInfo();
    return view('info', compact('currencies', 'cryptoCurrencies'));
})->middleware(['auth'])->name('rates-info');


Route::get('/accounts', [BankAccountController::class, 'index'])
    ->middleware(['auth'])->name('showAccounts');

Route::get('/accounts/create', [BankAccountController::class, 'create'])
    ->middleware(['auth'])->name('showCreateForm');

Route::post('/accounts/create', [BankAccountController::class, 'store'])
    ->middleware(['auth'])->name('create');

Route::get('/accounts/{bankAccount:id}', [BankAccountController::class, 'show'])
    ->middleware(['auth'])->name('show');

Route::post('/accounts/{bankAccount:id}', [BankAccountController::class, 'destroy'])
    ->middleware(['auth'])->name('deleteAccount');


Route::get('/investment-account', [InvestmentAccountController::class, 'index'])
    ->middleware(['auth'])->name('investmentAccounts');

Route::post('/investment-account', [InvestmentAccountController::class, 'store'])
    ->middleware(['auth'])->name('createInvestmentAccount');

Route::get('/investment-account/{investmentAccount:id}', [InvestmentAccountController::class, 'show'])
    ->middleware(['auth'])->name('showInvestmentAccount');

Route::post('/investment-account/{investmentAccount:id}', [InvestmentAccountController::class, 'destroy'])
    ->middleware(['auth'])->name('deleteInvestmentAccount');

Route::get('/investment-account/{investmentAccount:id}/buy-crypto', [InvestmentAccountController::class, 'showBuyCryptoAssetForm'])
    ->middleware(['auth'])->name('investment-account.buy-crypto-form');

Route::get('/investment-account/{investmentAccount:id}/sell-crypto', [InvestmentAccountController::class, 'showSellCryptoAssetForm'])
    ->middleware(['auth'])->name('investment-account.sell-crypto-form');

Route::post('/investment-account/{investmentAccount:id}/buy-crypto', [InvestmentAccountController::class, 'buyCryptoAsset'])
    ->middleware(['auth'])->name('investment-account.buy-crypto');

Route::post('/investment-account/{investmentAccount:id}/sell-crypto', [InvestmentAccountController::class, 'sellCryptoAsset'])
    ->middleware(['auth'])->name('investment-account.sell-crypto');


Route::get('/transactions/new', [TransactionController::class, 'create'])
    ->middleware(['auth'])->name('showTransactionForm');

Route::post('/transactions/new', [TransactionController::class, 'store'])
    ->middleware(['auth'])->name('createTransaction');

Route::get('/transactions/{transaction:id}', [TransactionController::class, 'show'])
    ->middleware(['auth']);


require __DIR__ . '/auth.php';

