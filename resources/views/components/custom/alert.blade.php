@props(['status', 'message'])
@php
    $class = 'text-green-900 rounded-lg bg-green-100';
    switch ($status) {
        case 'info':
            $class = 'text-blue-900 rounded-lg bg-blue-100';
            break;
        case 'warning':
            $class = 'text-yellow-900 rounded-lg bg-yellow-100';
            break;
        case 'danger':
        case 'error':
            $class = 'text-red-900 rounded-lg bg-red-100';
            break;
        case 'dark':
            $class = 'text-blue-900 rounded-lg bg-blue-100';
            break;
    }
@endphp

@if ($status && $message)
    <div 
        {{ $attributes->merge(['class' => 'p-4 mb-4 text-sm '. $class]) }}
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 5000)"
    >
        <span class="font-medium">{{ ucfirst($status) }}!</span> {{ $message }}
    </div>
@endif
