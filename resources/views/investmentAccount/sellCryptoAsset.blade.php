<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Your crypto assets') }}
            </h2>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl text-gray-800 leading-tight">
                <x-nav-link :href="route('investment-account.buy-crypto-form',$investmentAccount->id )"
                            :active="request()->routeIs('investment-account.buy-crypto-form')">
                    {{ __('Buy crypto') }}
                </x-nav-link>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="custom-div flex justify-end">
                        <a href="{{route('showInvestmentAccount', $investmentAccount->id)}}"
                           class="flex p-2 bg-gray-800 rounded-e-2xl">Back to account</a>
                    </div>
                    <div class="custom-div">
                        <h2>Current Assets</h2>
                        @if(count($currentAssets))
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Quantity</th>
                                    <th>Average purchase price, per one</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currentAssets as $cryptoAsset)
                                    <tr>
                                        <td>{{ $cryptoAsset->symbol }}</td>
                                        <td>{{ intval($cryptoAsset->total_quantity) }}</td>
                                        <td>{{ number_format($cryptoAsset->average_price,8)}} USD</td>
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
                    <br>
                    <br>
                    <br>
                    <div class="custom-div">
                        @if(count($cryptoAssets))
                            <h2>Sell Crypto Asset</h2>
                            <form action="{{ route('investment-account.sell-crypto', $investmentAccount) }}"
                                  method="POST" class="border border-gray-300 p-6">
                                @csrf
                                <div class="flex justify-between">

                                    <select name="crypto_asset_id" class="form-control" required>
                                        <option value="">Select Crypto Asset</option>
                                        @foreach($cryptoAssets as $cryptoAsset)
                                            <option value="{{ $cryptoAsset->id }}">{{ $cryptoAsset->name }}
                                                ({{ $cryptoAsset->symbol }}) - quantity -
                                                {{intval($cryptoAsset->quantity)}}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="quantity" id="quantity" required placeholder="Quantity">
                                    <input id="secret" type="text" name="secret" required placeholder="Secret key">
                                    <x-button type="submit" class="btn btn-primary">Sell</x-button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
