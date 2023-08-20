@props(['placeholder' => 'Choose an option'])

<select {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 mb-2']) }}>
    <option value="" selected>{{ $placeholder }}</option>
    {{ $slot }}
</select>