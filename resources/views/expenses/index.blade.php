<x-app-layout>
    <div class="pt-8 pb-12">
        <div class="md:max-w-7xl sm:max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900">
                    <div class="flex justify-between mb-5">
                        <h2 class="font-medium">{{ __('Expense List') }}</h2>
                        <x-custom.a-primary-button class="ml-4" :href="route('expenses.create')">
                            {{ __('Add Expense') }}
                        </x-custom.a-primary-button>
                    </div>
                    <x-custom.alert :status="session('status')" :message="session('message')" />
                    <x-custom.table :data="$expenses">
                        <x-slot name="header">
                            <th class="p-3">ID</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Description</th>
                            <th class="p-3">Amount</th>
                            <th class="p-3">Merchant</th>
                            <th class="p-3">Entry Date & Time</th>
                            <th class="p-3">
                                <x-custom.a-default-button :href="route('expenses.index')">Refresh</x-custom.a-default-button>
                            </th>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($expenses as $expense)
                                <tr class="border-b">
                                    <td class="p-3">{{ $expense->id }}</td>
                                    <td class="p-3">{{ $expense->expenseCategory->title }}</td>
                                    <td class="p-3">{{ $expense->description }}</td>
                                    <td class="p-3">{{ $expense->amount }}</td>
                                    <td class="p-3">{{ $expense->merchant }}</td>
                                    <td class="p-3">{{ $expense->entry_date }}</td>
                                    <td class="p-3">
                                        <form method="POST" action="{{ route('expenses.destroy', $expense) }}">
                                            @csrf
                                            @method('delete')
                                            <x-custom.a-warning-button class="p-1.5" :href="route('expenses.edit', $expense)">
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
