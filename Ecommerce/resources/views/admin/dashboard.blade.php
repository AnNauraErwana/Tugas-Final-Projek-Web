<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Statistics</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold">Total Products</h4>
                            <p class="text-3xl font-bold text-blue-600">{{ $productCount }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold">Total Users</h4>
                            <p class="text-3xl font-bold text-green-600">{{ $userCount }}</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h4 class="text-lg font-semibold">Total Stores</h4>
                            <p class="text-3xl font-bold text-yellow-600">{{ $storeCount }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
