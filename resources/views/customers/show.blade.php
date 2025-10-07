<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Customer Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Customer Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</p>
                                <p class="mt-1">{{ $customer->id }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                                <p class="mt-1">{{ $customer->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p class="mt-1">{{ $customer->email }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact</p>
                                <p class="mt-1">{{ $customer->contact }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                <p class="mt-1">
                                    <span>
                                        {{ ucfirst($customer->status) }}
                                    </span>
                                </p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</p>
                                <p class="mt-1">{{ $customer->created_at->format('M d, Y h:i A') }}</p>
                            </div>

                            <div class="md:col-span-2 lg:col-span-3">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</p>
                                <p class="mt-1">{{ $customer->address }}</p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</p>
                                <p class="mt-1">{{ $customer->updated_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                        <div class="flex justify-between items-center">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                                ← Back to List
                            </a>
                            <div class="flex space-x-1">
                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary">
                                    Edit
                                </a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <style>
                        .btn {
                            display: inline-block;
                            padding: 8px 16px;
                            border-radius: 4px;
                            text-decoration: none;
                            font-weight: bold;
                            border: none;
                            cursor: pointer;
                        }
                        .btn-primary {
                            background-color: #007bff;
                            color: white;
                        }
                        .btn-primary:hover {
                            background-color: #0056b3;
                            color: white;
                        }
                        .btn-secondary {
                            background-color: #6c757d;
                            color: white;
                        }
                        .btn-secondary:hover {
                            background-color: #545b62;
                            color: white;
                        }
                        .btn-danger {
                            background-color: #dc3545;
                            color: white;
                        }
                        .btn-danger:hover {
                            background-color: #c82333;
                            color: white;
                        }
                    </style>
                </div>
            </div>

            <!-- Conversations Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Conversations</h3>
                        <a href="{{ route('conversations.create', $customer) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition ease-in-out duration-150">
                            Add Conversation
                        </a>
                    </div>

                    @if($customer->conversations->count() > 0)
                        <div class="space-y-4">
                            @foreach($customer->conversations->sortByDesc('conversation_time') as $conversation)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <span class="px-2 py-1 text-xs font-semibold rounded 
                                                    @if($conversation->medium === 'call') bg-blue-100 text-blue-800
                                                    @elseif($conversation->medium === 'email') bg-purple-100 text-purple-800
                                                    @elseif($conversation->medium === 'sms') bg-green-100 text-green-800
                                                    @elseif($conversation->medium === 'meeting') bg-orange-100 text-orange-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst($conversation->medium) }}
                                                </span>
                                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ $conversation->conversation_time->format('M d, Y h:i A') }}
                                                </span>
                                            </div>
                                            @if($conversation->notes)
                                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $conversation->notes }}</p>
                                            @else
                                                <p class="text-sm text-gray-500 dark:text-gray-400 italic">No notes</p>
                                            @endif
                                        </div>
                                        <div class="flex items-center space-x-1 ml-4">
                                            <a href="{{ route('conversations.edit', [$customer, $conversation]) }}"  class="btn btn-primary">
                                                Edit
                                            </a>
                                            <form action="{{ route('conversations.destroy', [$customer, $conversation]) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this conversation?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No conversations yet. <a href="{{ route('conversations.create', $customer) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">Add the first conversation</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
