<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buy crypto') }}
            </h2>
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
                    <div class="custom-div flex justify-end">
                        <a href="{{route('showInvestmentAccount', $investmentAccount->id)}}"
                           class="flex p-2 bg-gray-800 rounded-e-2xl">Back to account</a>
                    </div>
                    <div class="custom-div">
                        <h2>Buy Crypto Asset</h2>
                    </div>
                    <form action="{{ route('investment-account.buy-crypto', $investmentAccount) }}" method="POST"
                          class="border border-gray-300 p-6">
                        @csrf
                        <div class="flex justify-between ">
                            <div>
                                <select name="crypto_currency_id" id="crypto_currency_id" required>
                                    <option value="">Select Crypto Currency</option>
                                    @foreach($cryptoCurrencies as $cryptoCurrency)
                                        <option value="{{ $cryptoCurrency->id }}">{{ $cryptoCurrency->name }}
                                            ({{ $cryptoCurrency->symbol }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="number" name="quantity" required placeholder="Quantity">
                            </div>
                            <div>
                                <input type="text" name="secret" required placeholder="Secret key">
                            </div>
                            <div>
                                <x-button type="submit" class="">Buy</x-button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <br>
                    <div class="custom-div">
                        <h2>Info about cryptocurrency exchange rates to USD</h2>
                        <p>New rates are typically published between 15:15 GMT+2 and 16:00 GMT+2.</p>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Cryptocurrency</th>
                                <th class="px-4 py-2">Symbol</th>
                                <th class="px-4 py-2">Price (USD)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cryptoCurrencies as $cryptoCurrency)
                                <tr>
                                    <td class="border px-4 py-2">{{ $cryptoCurrency->name }}</td>
                                    <td class="border px-4 py-2">{{ $cryptoCurrency->symbol }}</td>
                                    <td class="border px-4 py-2">{{ $cryptoCurrency->price_usd }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
