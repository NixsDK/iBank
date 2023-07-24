<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Accounts') }}
            </h2>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-xl text-gray-800 leading-tight">
                <x-nav-link :href="route('showTransactionForm')" :active="request()->routeIs('showTransactionForm')">
                    {{ __('New transaction') }}
                </x-nav-link>
            </div>
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
                            @if($bankAccounts->isEmpty())
                                <div class="custom-div">
                                    <h2 class="font-bold text-xl mb-4">At the moment you dont have any bank
                                        accounts.</h2>
                                </div>
                                <div class="custom-div mb-4 ">
                                    <a href="/accounts/create" class="flex p-2 bg-gray-800 rounded-e-2xl">Make new
                                        account</a>
                                </div>
                        </div>
                        <br>
                        <div class="custom-div border-b-2">
                        </div>
                        <div class="custom-div border-b-2">
                            <p>Our bank accounts provide the flexibility for users to have as many bank accounts as they
                                like, supporting up to 30 different currencies. This allows you to manage your finances
                                seamlessly across multiple currencies, making international transactions and currency
                                conversions more convenient</p>
                            <br>
                            <p>Here are some of the benefits of opening bank accounts with us:</p>
                            <ul>
                                <li><span>Secure Deposits</span>: Safely deposit your money into your bank accounts,
                                    knowing that your funds are protected.
                                </li>
                                <li><span>Online Banking</span>: Access your accounts anytime, anywhere through our
                                    secure online banking platform.
                                </li>
                                <li><span>Mobile Banking</span>: Stay connected on the go with our mobile banking app,
                                    allowing you to manage your accounts from your smartphone or tablet.
                                </li>
                                <li><span>Transaction History</span>: Easily track and review your transaction history,
                                    ensuring that you have a clear overview of your financial activities.
                                </li>
                                <li><span>Bill Payments</span>: Conveniently pay your bills online, saving you time and
                                    eliminating the hassle of writing checks or visiting payment centers.
                                </li>
                                <li><span>Money Transfers</span>: Transfer funds between your accounts or send money to
                                    family and friends quickly and securely.
                                </li>
                                <li><span>Customer Support</span>: Our dedicated customer support team is available to
                                    assist you with any questions or concerns you may have.
                                </li>

                            </ul>
                        </div>

                        @else
                            <div class="custom-div">
                                <p class="font-bold text-xl mb-4">Your accounts:</p>
                            </div>
                            <div class="custom-div mb-4 ">
                                <a href="/accounts/create" class="flex p-2 bg-gray-800 rounded-e-2xl">Make new
                                    account</a>
                            </div>
                    </div>
                    @foreach($bankAccounts as $bankAccount)
                        <a href="accounts/{{$bankAccount->id}}">
                            <div class="flex justify-between gap-2 border border-gray-200 p-6 rounded-xl">
                                <h2 class="font-bold text-xl m-4">{{$bankAccount->currency}}</h2>
                                <p class="text-lg m-4">{{$bankAccount->account_number}}</p>
                                <p class="text-lg m-4">{{$bankAccount->balance}} {{$bankAccount->currency}}</p>
                                <p class="text-lg m-4">{{$bankAccount->created_at}}</p>
                                <x-button class="flex">View</x-button>
                            </div>
                        </a>
                    @endforeach
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
