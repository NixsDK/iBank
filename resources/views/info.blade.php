<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rates info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="custom-div flex justify-end">
                        <a href="{{route('showAccounts')}}" class="flex p-2 bg-gray-800 rounded-e-2xl">Back</a>
                    </div>
                    <div class="custom-div">
                        <h2 class="text-xl font-bold mb-4">Info about currency exchange rates for 1 EUR</h2>
                        <p>New rates are typically published between 15:15 GMT+2 and 16:00 GMT+2.</p>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Currency</th>
                                <th class="px-4 py-2">Exchange Rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($currencies as $currency)
                                @if($currency->id != 'EUR')
                                    <tr>
                                        <td class="border px-4 py-2">{{ $currency->id }}</td>
                                        <td class="border px-4 py-2">{{ $currency->rate }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
