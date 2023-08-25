<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
            <h1 class="font-medium text-2xl mb-5">Reports</h1>
            
            <!-- Filter -->
            <div>
                <form method="get" class="md:flex md:space-x-3 items-center mb-5">
                    <div class="w-full">
                        <x-input-label class="mb-2" for="year" :value="__('Year')" />
                        <x-custom.select name="year" id="year" class="text-sm">
                            @php
                                $startedYear = $startedDate ? date('Y', strtotime($startedDate)) : 2000;
                            @endphp
                            @foreach(array_combine(range(date('Y'), $startedYear), range(date('Y'), $startedYear)) as $year)
                                <option 
                                    value="{{ $year }}" 
                                    @if($year == old('year', Request::get('year', date('Y')))) 
                                        selected 
                                    @endif
                                >
                                    {{ $year }}
                                </option>
                            @endforeach
                        </x-custom.select>
                    </div>
                    <div class="w-full">
                        <x-input-label class="mb-2" for="month" :value="__('Month')" />
                        <x-custom.select name="month" id="month" class="text-sm">
                            <option value="">All</option>
                            @foreach(config('global.months') as $key => $month)
                                <option value="{{ $key }}" 
                                    @if($key == old('month', Request::get('month', date('n')))) 
                                        selected 
                                    @endif
                                >
                                    {{ $month }}
                                </option>
                            @endforeach
                        </x-custom.select>
                    </div>
                    <div class="w-full">
                        <br>
                        <x-primary-button type="submit">{{ __('Filter') }}</x-primary-button>
                    </div>
                </form>
            </div>
            
            <!-- Tables -->
            <div class="grid md:grid-cols-2 gap-4 w-full mb-3">
                <div>
                    <h2 class="font-medium text-xl mb-3">Expenses</h2>
                    <x-custom.table :data="[]" class="text-sm border-x">
                        <x-slot name="header">
                            <th class="p-3">Category</th>
                            <th class="p-3">Amount</th>
                        </x-slot>
                        <x-slot name="body">
                            @forelse ($expenses as $expense)
                                <tr class="border-b">
                                    <td class="p-3">{{ $expense->expenseCategory->title }}</td>
                                    <td class="p-3">{{ number_format($expense->amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr class="border-b">
                                    <td class="p-3 text-center" colspan="2">No record found..</td>
                                </tr>
                            @endforelse
                        </x-slot>
                        <x-slot name="footer">
                            <tr class="border-b bg-gray-50">
                                <td class="p-3">Total</td>
                                <td class="p-3">{{ number_format($totalExpenses, 2) }}</td>
                            </tr>
                        </x-slot>
                    </x-custom.table>                    
                </div>
                <div>
                    <h2 class="font-medium text-xl mb-3">Incomes</h2>
                    <x-custom.table :data="[]" class="text-sm border-x">
                        <x-slot name="header">
                            <th class="p-3">Category</th>
                            <th class="p-3">Amount</th>
                        </x-slot>
                        <x-slot name="body">
                            @forelse ($incomes as $income)
                                <tr class="border-b">
                                    <td class="p-3">{{ $income->incomeCategory->title }}</td>
                                    <td class="p-3">{{ number_format($income->amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr class="border-b">
                                    <td class="p-3 text-center" colspan="2">No record found..</td>
                                </tr>
                            @endforelse
                        </x-slot>
                        <x-slot name="footer">
                            <tr class="border-b bg-gray-50">
                                <td class="p-3">Total</td>
                                <td class="p-3">{{ number_format($totalIncomes, 2) }}</td>
                            </tr>
                        </x-slot>
                    </x-custom.table>
                </div>
            </div>

            <!-- Balance -->
            <div>
                <h3 class="text-lg text-center">
                    <strong>Balance: </strong> {{ number_format($totalIncomes - $totalExpenses, 2) }}
                </h3>
            </div>
        </div>
    </div>
</x-app-layout>
