@php use App\Models\BankAccount; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction details')  }}
        </h2>
    </x-slot>
    <div class="py-12">
        <x-flash/>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <div class="custom-div flex justify-between">
                        <h2 class="text-xl">Info about transaction: </h2>
                        <a href="{{route('showAccounts')}}" class="flex p-2 bg-gray-800 rounded-e-2xl">Back to
                            accounts</a>
                    </div>
                    <div class="flex justify-between gap-2 border border-gray-200 p-6 rounded-xl mt-2">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>To</th>
                                <th>Date</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ BankAccount::findorfail($transaction->receiver_account_id)->account_number  }}</td>
                                <td>{{ $transaction->completed_at }}</td>
                                <td>{{ $transaction->currency }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->description }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


