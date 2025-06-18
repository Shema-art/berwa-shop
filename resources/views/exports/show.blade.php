<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Export Details') }}: {{ $export->name }}
            </h2>
            <div>
                <a href="{{ route('exports.edit', $export) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-900 focus:outline-none focus:border-amber-900 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Edit Export') }}
                </a>
                <a href="{{ route('exports.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-600 active:bg-gray-500 dark:active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 dark:ring-gray-600 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Back to Exports') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                      
                        <!-- Export Details -->
                        <div class="md:col-span-2">
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Product:</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $export->product->name }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Quantity:</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $export->quantity }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Price:</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $export->price }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Price:</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $export->total_price }}</p>
                            </div>
                        
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Last Updated:</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $export->updated_at->format('F j, Y, g:i a') }}</p>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Created At:</p>
                                <p class="text-lg text-gray-800 dark:text-gray-200">{{ $export->created_at->format('F j, Y, g:i a') }}</p>
                            </div>

                            <!-- Add more details as needed -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 