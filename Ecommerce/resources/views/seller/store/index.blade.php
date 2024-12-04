<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $store ? $store->name : __('My Store') }}
        </h2>
    </x-slot>

    @php
        $store = Auth::user()->store;
    @endphp

    @if ($store)
        <div class="max-w-4xl mx-auto mt-10 p-6 bg-gradient-to-r from-white to-gray-100 shadow-lg rounded-lg">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <!-- Gambar Store -->
                <img src="{{ asset($store->image) }}" 
                    alt="{{ $store->name }}" 
                    class="w-40 h-40 object-cover rounded-md border border-gray-300 shadow-md">
                
                <!-- Informasi Store -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $store->name }}</h1>
                    <p class="text-gray-600 text-sm">{{ $store->description }}</p>
                    
                    <!-- Tombol Edit Store -->
                    <a href="{{ route('seller.store.edit', $store->id) }}" 
                        class="inline-block px-6 py-2 mt-4 bg-yellow-500 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-600 transition duration-300">
                        Edit Store
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="max-w-3xl mx-auto mt-10 p-8 bg-gray-50 shadow-lg rounded-lg border border-gray-200">
            <p class="text-center text-lg text-gray-700 font-medium">You don't have a store yet.</p>
            <a href="{{ route('seller.store.create') }}" 
                class="block text-center px-6 py-2 mt-6 bg-brown text-white font-semibold rounded-lg shadow-md hover:bg-brown2 transition duration-300">
                Create Your Store
            </a>
        </div>
    @endif
</x-app-layout>
