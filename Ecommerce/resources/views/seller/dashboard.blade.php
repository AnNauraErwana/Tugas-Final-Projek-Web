<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }}
        </h2>
    </x-slot>

    @php
        $store = Auth::user()->store;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-antique via-white to-antique shadow-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Check if seller has a store -->
                    @if($store)
                        <h3 class="text-2xl font-semibold text-gray-800">Store Information</h3>

                        <!-- Display store image if exists -->
                        @if($store->image)
                            <div class="mb-4">
                                <img src="{{ asset($store->image) }}" alt="Store Image" class="w-32 h-32 object-cover rounded-md mx-auto" />
                            </div>
                        @else
                            <p class="text-gray-500 text-center">No store image uploaded yet.</p>
                        @endif

                        <!-- Store Name and Description -->
                        <div class="mt-4 text-gray-700">
                            <p><strong class="font-semibold">Store Name:</strong> {{ $store->name }}</p>
                            <p><strong class="font-semibold">Description:</strong> {{ $store->description }}</p>
                        </div>

                        <!-- Store Stats Section -->
                        <div class="mt-8">
                            <h3 class="text-2xl font-semibold text-gray-800">Store Statistics</h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                                <!-- Total Products -->
                                <div class="p-6 border border-gray-200 rounded-md shadow-sm hover:shadow-lg transition duration-300">
                                    <h4 class="font-semibold text-gray-800">Total Products</h4>
                                    <p class="text-lg text-gray-600">{{ $store->products->count() }}</p>
                                </div>
                                
                                <!-- Total Orders -->
                                
                            </div>
                        </div>
                    @else
                        <!-- If seller has no store, show this message -->
                        <div class="text-center py-8">
                            <p class="text-lg text-gray-600">You don't have a store yet. Please create a store to start selling products.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
