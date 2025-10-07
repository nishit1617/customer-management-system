<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Send Message to Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label :value="__('Recipients')" />
                            <div class="mt-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-md">
                                @if($customers->count() > 0)
                                    <p class="text-sm mb-2">Sending to:</p>
                                    <ul class="list-disc list-inside text-sm">
                                        @foreach($customers as $customer)
                                            <li>{{ $customer->name }}</li>
                                            <input type="hidden" name="customer_ids[]" value="{{ $customer->id }}">
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-red-600">No customers selected. Please go back and select customers.</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="type" :value="__('Message Type')" />
                            <select id="type" name="type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="email" {{ old('type') == 'email' ? 'selected' : '' }}>Email</option>
                                <option value="sms" {{ old('type') == 'sms' ? 'selected' : '' }}>SMS</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="subject" :value="__('Subject')" />
                            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="body" :value="__('Message')" />
                            <textarea id="body" name="body" rows="6" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('body') }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 transition ease-in-out duration-150 mr-3">
                                Cancel
                            </a>
                            <x-primary-button :disabled="$customers->count() === 0">
                                {{ __('Send Message') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
