<x-app-layout>
    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
            <form method="POST" action="{{ route('income-categories.update', $incomeCategory) }}">
                @csrf
                @method('patch')

                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $incomeCategory->title)" placeholder="Title" required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-custom.link class="underline text-sm" href="{{ route('income-categories.index') }}">{{ __('Go back') }}</x-custom.link>

                    <x-primary-button class="ml-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
