@props(['status', 'errors'])

@if ($status)
    <div
        {{ $attributes->merge(['class' => 'flex items-center justify-center border bg-green-800 rounded-xl text-lg text-white font-medium py-2 px-4']) }}
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 011-1v3a1 1 0 11-2 0V9a1 1 0 011-1z"
                  clip-rule="evenodd"/>
        </svg>
        {{ $status }}
    </div>
@elseif ($errors->any())
    <div
        {{ $attributes->merge(['class' => 'flex items-center justify-center border bg-red-800 rounded-xl text-lg text-white font-medium py-2 px-4']) }}
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show">
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 011-1v3a1 1 0 11-2 0V9a1 1 0 011-1z"
                  clip-rule="evenodd"/>
        </svg>
        {{ $errors->first() }}
    </div>
@endif
