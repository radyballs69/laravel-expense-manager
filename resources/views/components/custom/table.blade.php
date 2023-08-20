@props(['data'])

<div class="relative overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'w-full text-left text-gray-500 rounded mb-4 border-t shadow']) }}>
        <thead class="py-2 font-medium text-gray-700">
            <tr class="border-b bg-gray-50">
                {{ $header }}
            </tr>
        </thead>
        <tbody>{{ $body }}</tbody>
    </table>
    @if($data)
        <div>
            {{ $data->appends(Request::all())->links() }}
        </div>
    @endif
</div>