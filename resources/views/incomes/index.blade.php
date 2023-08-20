<x-app-layout>
    <div class="pt-8 pb-12">
        <div class="md:max-w-7xl sm:max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900">
                    <div class="flex justify-between mb-5">
                        <h2 class="font-medium">{{ __('Income List') }}</h2>
                        <x-custom.a-primary-button class="ml-4" :href="route('incomes.create')">
                            {{ __('Add Income') }}
                        </x-custom.a-primary-button>
                    </div>
                    <x-custom.alert :status="session('status')" :message="session('message')" />
                    <x-custom.table :data="$incomes">
                        <x-slot name="header">
                            <th class="p-3">ID</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Description</th>
                            <th class="p-3">Amount</th>
                            <th class="p-3">Entry Date & Time</th>
                            <th class="p-3">
                                <x-custom.a-default-button :href="route('incomes.index')">Refresh</x-custom.a-default-button>
                            </th>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($incomes as $income)
                                <tr class="border-b">
                                    <td class="p-3">{{ $income->id }}</td>
                                    <td class="p-3">{{ $income->incomeCategory->title }}</td>
                                    <td class="p-3">{{ $income->description }}</td>
                                    <td class="p-3">{{ $income->amount }}</td>
                                    <td class="p-3">{{ $income->entry_date }}</td>
                                    <td class="p-3">
                                        <form method="POST" action="{{ route('incomes.destroy', $income) }}">
                                            @csrf
                                            @method('delete')
                                            <x-custom.a-warning-button class="p-1.5" :href="route('incomes.edit', $income)">
                                                {{ __('Edit') }}
                                            </x-custom.a-warning-button>
                                            <x-custom.a-danger-button class="p-1.5" 
                                                href="#"
                                                onclick="event.preventDefault(); if (confirm('Are you sure to continue?')) this.closest('form').submit();
                                                "
                                            >
                                                {{ __('Delete') }}
                                            </x-custom.a-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b">
                                    <td class="p-3 text-center" colspan="6">There are no records.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-custom.table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
