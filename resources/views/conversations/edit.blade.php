<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Conversation for') }} {{ $customer->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('conversations.update', [$customer, $conversation]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="conversation_time" :value="__('Date & Time')" />
                            <x-text-input id="conversation_time" class="block mt-1 w-full" type="datetime-local" name="conversation_time" :value="old('conversation_time', $conversation->conversation_time->format('Y-m-d\TH:i'))" required />
                            <x-input-error :messages="$errors->get('conversation_time')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="medium" :value="__('Communication Medium')" />
                            <select id="medium" name="medium" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select Medium</option>
                                <option value="call" {{ old('medium', $conversation->medium) == 'call' ? 'selected' : '' }}>Call</option>
                                <option value="email" {{ old('medium', $conversation->medium) == 'email' ? 'selected' : '' }}>Email</option>
                                <option value="sms" {{ old('medium', $conversation->medium) == 'sms' ? 'selected' : '' }}>SMS</option>
                                <option value="meeting" {{ old('medium', $conversation->medium) == 'meeting' ? 'selected' : '' }}>Meeting</option>
                                <option value="other" {{ old('medium', $conversation->medium) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('medium')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('notes', $conversation->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('customers.show', $customer) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 transition ease-in-out duration-150 mr-3">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Conversation') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
