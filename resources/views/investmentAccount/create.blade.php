<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new bank account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-4">Select currency for your account:</h1>
                    <form method="Post" name="currency" action="{{route('create')}}" novalidate>
                        @csrf
                        <select name="currency">
                            @foreach($currencies as $currency)
                                <option>{{$currency->getId()}}</option>
                            @endforeach
                            @error('currency')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </select>
                        <x-button class="mt-4">{{ __('Make new account') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

