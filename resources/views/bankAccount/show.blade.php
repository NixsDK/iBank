@php use App\Models\BankAccount; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$bankAccount->account_number}}
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
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <div class="flex justify-between gap-1">
                        <div class="custom-div m-4">
                            <h2 class="text-xl">Info about account: </h2>
                            <p>Type: {{$bankAccount->currency}}</p>
                            <p>Account number: {{$bankAccount->account_number}}</p>
                            <p>Balance: {{$bankAccount->balance}} {{$bankAccount->currency}}</p>
                            <p>Created
                                at: {{ $bankAccount->created_at->setTimezone(auth()->user()->timezone)->format('Y-m-d H:i:s') }}</p>
                            <form method="post" name="delete" action="{{route('deleteAccount', $bankAccount->id)}}"
                                  novalidate>
                                @csrf
                                <x-button class="mt-4">{{ __('Delete account') }}</x-button>
                            </form>
                        </div>
                        <div class="custom-div">
                            <a href="{{route('showAccounts')}}" class="flex p-2 bg-gray-800 rounded-e-2xl">Back</a>
                        </div>
                    </div>
                    <div class="mt-4 flex-grow">
                        <div class="custom-div h-full">
                            <h2 class="font-bold text-xl mb-4">In total you have ({{ $transactions->total() }})
                                transactions for this account. </h2>
                            <h2 class="font-bold text-xl mb-4">Transactions history: </h2>
                            @if ($transactions->count() > 0)
                                <div class="flex flex-col h-full">
                                    <div class="bg-gray-100 p-4">
                                        <div class="flex justify-end mb-4">
                                            <div class="mr-2">
                                                <label for="type" class="font-bold mr-2">Filter by Type:</label>
                                                <select id="type" name="type"
                                                        class="border border-gray-300 rounded px-4 py-2 mt-2  focus:outline-none focus:border-indigo-500">
                                                    <option
                                                        value="all" {{ request()->input('type') === 'all' ? 'selected' : '' }}>
                                                        All
                                                    </option>
                                                    <option
                                                        value="withdrawal" {{ request()->input('type') === 'withdrawal' ? 'selected' : '' }}>
                                                        Withdrawal
                                                    </option>
                                                    <option
                                                        value="deposit" {{ request()->input('type') === 'deposit' ? 'selected' : '' }}>
                                                        Deposit
                                                    </option>
                                                </select>
                                                <button onclick="applyFilter()"
                                                        class="px-4 py-2 bg-gray-800 text-white rounded">Apply
                                                </button>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>From/To</th>
                                                <th>Date</th>
                                                <th>Currency</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Type</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($transactions as $transaction)
                                                @php
                                                    $transactionType = ($transaction->sender_account_id === $bankAccount->id) ? 'withdrawal' : 'deposit';
                                                @endphp
                                                @if (request()->input('type') === 'all' || request()->input('type') === $transactionType)
                                                    <tr>
                                                        @if ($transactionType === 'withdrawal')
                                                            <td>
                                                                To: {{ BankAccount::findorfail($transaction->receiver_account_id)->account_number  }}</td>
                                                        @else
                                                            <td>
                                                                From: {{ BankAccount::findorfail($transaction->sender_account_id)->account_number }}</td>
                                                        @endif
                                                        <td>{{ $transaction->completed_at }}</td>
                                                        <td>{{ $transaction->currency }}</td>
                                                        <td>{{ $transaction->amount }}</td>
                                                        <td>{{ $transaction->description }}</td>
                                                        <td>
                                                            @if ($transactionType === 'withdrawal')
                                                                <p class="bg-red-900">Withdrawal</p>
                                                            @else
                                                                <p class="bg-green-900">Deposit</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="custom-div mt-8 text-center">
                                    <p> No transactions yet. Please check later!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="custom-div mt-4">
                        {{ $transactions->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function applyFilter() {
            const type = document.getElementById('type').value;
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('type', type);
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }
    </script>
</x-app-layout>
