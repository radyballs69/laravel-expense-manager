@props(['active'])

@php
$classes = ($active ?? false)
            ? 'border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<div {{ $attributes->merge(['class' => 'hidden sm:flex sm:items-center sm:ml-6 '. $classes]) }}>
    {{ $slot }}
</div>