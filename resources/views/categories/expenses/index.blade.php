<x-app-layout>
    <div class="pt-8 pb-12">
        <div class="md:max-w-3xl sm:max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-5 text-gray-900">
                    <div class="flex justify-between mb-5">
                        <h2 class="font-medium">{{ __('Expense Category List') }}</h2>
                        <x-custom.a-primary-button class="ml-4" :href="route('expense-categories.create')">
                            {{ __('Add Expense Category') }}
                        </x-custom.a-primary-button>
                    </div>
                    <x-custom.alert :status="session('status')" :message="session('message')" />
                    <x-custom.table class="table-fixed" :data="$expenseCategories">
                        <x-slot name="header">
                            <th class="p-3">ID</th>
                            <th class="p-3">Title</th>
                            <th class="p-3">
                                <x-custom.a-default-button :href="route('expense-categories.index')">Refresh</x-custom.a-default-button>
                            </th>
                        </x-slot>
                        <x-slot name="body">
                            @forelse($expenseCategories as $expenseCat)
                                <tr class="border-b">
                                    <td class="p-3">{{ $expenseCat->id }}</td>
                                    <td class="p-3">{{ $expenseCat->title }}</td>
                                    <td class="p-3">
                                        <form method="POST" action="{{ route('expense-categories.destroy', $expenseCat) }}">
                                            @csrf
                                            @method('delete')
                                            <x-custom.a-warning-button class="p-1.5" :href="route('expense-categories.edit', $expenseCat)">
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
                                    <td class="p-3" colspan="3">There are no records.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-custom.table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
