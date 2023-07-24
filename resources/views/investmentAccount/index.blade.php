<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Investment Account') }}
            </h2>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl text-gray-800 leading-tight">
                <x-nav-link :href="route('rates-info')" :active="request()->routeIs('rates-info')">
                    {{ __('Rates info') }}
                </x-nav-link>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div class="flex justify-between">
                            @if(count(auth()->user()->investmentAccounts)<1)
                                <div class="custom-div">
                                    <h2 class="font-bold text-xl mb-4">At the moment you dont have an investment account
                                        !</h2>
                                </div>
                                <div class="custom-div mb-4 ">
                                    <form method="POST">
                                        @csrf
                                        <x-button type="submit">Make new investment account</x-button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        @if(count(auth()->user()->investmentAccounts)>0)
                            <div class="custom-div">
                                <p class="font-bold text-xl mb-4">Your accounts:</p>
                            </div>
                            <a href="investment-account/{{$investmentAccount->id}}">
                                <div class="flex justify-between gap-2 border border-gray-200 p-6 rounded-xl">
                                    <h2 class="font-bold text-xl m-4">{{$investmentAccount->currency}}</h2>
                                    <p class="text-lg m-4">{{$investmentAccount->account_number}}</p>
                                    <p class="text-lg m-4">{{$investmentAccount->balance}} {{$investmentAccount->currency}}</p>
                                    <p class="text-lg m-4">{{$investmentAccount->created_at}}</p>
                                    <x-button class="flex">Interact</x-button>
                                </div>
                            </a>
                        @else
                            <br>
                            <div class="custom-div border-b-2">
                            </div>
                            <div class="custom-div border-b-2">
                                <p>We offer open one investment account in USD only, due to the stability and widespread
                                    acceptance of the United States Dollar in the global financial markets.</p>
                                <br>
                                <p>Here are some of the benefits of opening an investment account with us:</p>
                                <ul>
                                    <li><span>Deposit Money</span>: Easily add funds to your investment account and
                                        start building your portfolio.
                                    </li>
                                    <li><span>Buy Cryptocurrency</span>: Take advantage of the booming digital asset
                                        market by purchasing a wide range of cryptocurrencies.
                                    </li>
                                    <li><span>Sell Cryptocurrency</span>: When the time is right, sell your
                                        cryptocurrencies to capitalize on market trends and secure potential profits.
                                    </li>
                                    <li><span>Real-Time Market Data</span>: Stay informed with up-to-date market
                                        information, including price charts, trends, and performance indicators.
                                    </li>
                                    <li><span>Portfolio Management</span>: Track the performance of your investments,
                                        view your asset allocation, and monitor your overall portfolio growth.
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section>
        <x-flash/>
    </section>
</x-app-layout>
