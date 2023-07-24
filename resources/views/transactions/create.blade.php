<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-flash/>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="custom-div flex justify-between">
                        <h1 class="mb-4">Create a new transaction:</h1>
                        <a href="{{route('showAccounts')}}" class="flex p-2 bg-gray-800 rounded-e-2xl">Back</a>
                    </div>
                    <form method="POST" action="{{ route('createTransaction') }} " novalidate>
                        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                        @csrf
                        <div class="mb-4">
                            <label for="sender_account_id" class="block text-gray-700 text-sm font-bold mb-2">Sender
                                Account:</label>
                            <select name="sender_account_id" id="sender_account_id"
                                    class="form-select block w-full mt-1">
                                <option value="">Select Account</option>
                                @foreach($bankAccounts as $account)
                                    <option
                                        value="{{ $account->id }}">{{ $account->account_number }} {{$account->currency}}
                                    </option>
                                @endforeach
                                @foreach($investmentAccounts as $account)
                                    <option
                                        value="{{ $account->id }}">{{ $account->account_number }} {{$account->currency}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <x-label for="receiver_account_number" class="block text-gray-700 text-sm font-bold mb-2">
                                Receiver Account Number:
                            </x-label>
                            <x-input type="text" name="receiver_account_number" id="receiver_account_number"
                                     value="{{old('receiver_account_number')}}"
                                     class="form-input block w-full mt-1"/>
                        </div>
                        <div class="mb-4">
                            <x-label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</x-label>
                            <x-input type="number" name="amount" id="amount" value="{{old('amount')}}"
                                     class="form-input block w-full mt-1"/>
                        </div>
                        <div class="mb-4">
                            <x-label for="receiver_account_number" class="block text-gray-700 text-sm font-bold mb-2">
                                Description:
                            </x-label>
                            <x-input type="text" name="description" id="description" value="{{old('description')}}"
                                     class="form-input block w-full mt-1"/>
                        </div>
                        <div class="mb-4">
                            <x-label for="secret" :value="__('Secret key:')"/>
                            <x-input id="secret" class="block w-full mt-1" type="text" name="secret" required/>
                        </div>
                        <x-button class="mt-4">{{ __('Create Transaction') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

