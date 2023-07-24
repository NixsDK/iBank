@php use App\Models\BankAccount; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$investmentAccount->account_number}}
            </h2>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl text-gray-800 leading-tight">
                <x-nav-link :href="route('showTransactionForm')" :active="request()->routeIs('showTransactionForm')">
                    {{ __('Add funds') }}
                </x-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl text-gray-800 leading-tight">
                <x-nav-link :href="route('showTransactionForm')" :active="request()->routeIs('showTransactionForm')">
                    {{ __('Transfer funds') }}
                </x-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl text-gray-800 leading-tight">
                <x-nav-link :href="route('investment-account.buy-crypto-form',$investmentAccount->id )"
                            :active="request()->routeIs('investment-account.buy-crypto-form')">
                    {{ __('Buy crypto') }}
                </x-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl text-gray-800 leading-tight">
                <x-nav-link :href="route('investment-account.sell-crypto-form', $investmentAccount->id)"
                            :active="request()->routeIs('investment-account.sell-crypto-form')">
                    {{ __('Crypto assets') }}
                </x-nav-link>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between gap-1 border-b-2">
                        <div class="custom-div m-4">
                            <h2 class="text-xl">Info about account: </h2>
                            <p>Type: {{$investmentAccount->currency}}</p>
                            <p>Account number: {{$investmentAccount->account_number}}</p>
                            <p>Balance: {{$investmentAccount->balance}} {{$investmentAccount->currency}}</p>
                            <p>Created
                                at: {{ $investmentAccount->created_at->setTimezone(auth()->user()->timezone)->format('Y-m-d H:i:s') }}</p>
                            <form method="post" name="delete"
                                  action="{{route('deleteInvestmentAccount', $investmentAccount->id)}}"
                                  novalidate>
                                @csrf
                                <x-button class="mt-4 mb-4">{{ __('Delete account') }}</x-button>
                            </form>
                        </div>
                        <div class="custom-div">
                            <a href="{{route('investmentAccounts')}}"
                               class="flex p-2 bg-gray-800 rounded-e-2xl">Back</a>
                        </div>
                    </div>
                    <br>
                    <div class="custom-div">
                        <div class="custom-div flex justify-between">
                            <h2 class="mt-2">Current crypto assets</h2>
                            <div class="flex justify-between">
                                <a class="flex p-2 mt-2 mr-2 bg-gray-800 rounded-e-2xl"
                                   href="{{ route('investment-account.buy-crypto', $investmentAccount) }}">Buy
                                    Crypto</a>
                                <a class="flex p-2 mt-2 bg-gray-800 rounded-e-2xl"
                                   href="{{ route('investment-account.sell-crypto', $investmentAccount) }}">Sell
                                    Crypto</a>
                            </div>
                        </div>
                        @if(count($currentAssets))
                            <table class="table mt-2">
                                <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Quantity</th>
                                    <th>Average purchase price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currentAssets as $cryptoAsset)
                                    <tr>
                                        <td>{{ $cryptoAsset->symbol }}</td>
                                        <td>{{ intval($cryptoAsset->total_quantity) }}</td>
                                        <td>{{ number_format($cryptoAsset->average_price,8) }} USD</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="custom-div">
                                <p>No assets found. Buy them here:</p>
                                <a class="flex ml-2 p-2 bg-gray-800 rounded-e-2xl"
                                   href="{{ route('investment-account.buy-crypto', $investmentAccount) }}">Buy
                                    Crypto</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
