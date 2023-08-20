<x-app-layout>
    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
            <x-custom.alert :status="session('status')" :message="session('message')" />
            <form class="space-y-3.5" method="POST" action="{{ route('expenses.store') }}">
                @csrf

                <!-- Expense Categories -->
                <div>
                    <x-input-label class="mb-2" for="expense_category_id" :value="__('Expense Category')" />
                    <x-custom.select id="expense_category_id" name="expense_category_id" required autofocus>
                        @if(! empty($expenseCategories))
                            @foreach ($expenseCategories as $expenseCat)
                            <option value="{{ $expenseCat->id }}"
                                @selected(old('expense_category_id') == $expenseCat->id)
                            >{{ $expenseCat->title }}</option>
                            @endforeach
                        @endif
                    </x-custom.select>
                </div>

                <!-- Entry Date -->
                <div>
                    <x-input-label class="mb-2" for="entry_date" :value="__('Entry Date')" />
                    <x-text-input id="entry_date" class="block mt-1 w-full" type="date" name="entry_date" :value="old('entry_date')" required />
                    <x-input-error :messages="$errors->get('entry_date')" class="mt-2" />
                </div>

                <!-- Entry Time -->
                <div>
                    <x-input-label class="mb-2" for="entry_time" :value="__('Entry Time')" />
                    <x-text-input id="entry_time" class="block mt-1 w-full" type="time" name="entry_time" :value="old('entry_time')" required />
                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                </div>

                <!-- Amount -->
                <div>
                    <x-input-label class="mb-2" for="amount" :value="__('Amount')" />
                    <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" placeholder="Amount" required />
                    <x-input-error :messages="$errors->get('number')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label class="mb-2" for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" placeholder="Description" required />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Merchant -->
                <div>
                    <x-input-label class="mb-2" for="merchant" :value="__('Merchant')" />
                    <x-text-input id="merchant" class="block mt-1 w-full" type="text" name="merchant" :value="old('merchant')" placeholder="Merchant" required autofocus />
                    <x-input-error :messages="$errors->get('merchant')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-custom.link class="underline text-sm" href="{{ route('expenses.index') }}">{{ __('Go back') }}</x-custom.link>

                    <x-primary-button class="ml-4">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
