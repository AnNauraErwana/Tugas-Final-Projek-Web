<!-- resources/views/categories/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Category') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10 mb-10 p-8 bg-white shadow-md rounded">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required value="{{ old('name') }}">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <a href="{{ route('seller.product.create') }}" class="px-6 py-2 mt-4 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition duration-300">Back</a>
            <button type="submit" class="px-6 py-2 mt-4 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition duration-300"><a href="{{ route('categories.create') }}" ></a>Create Category</button>
        </form>
    </div>
</x-app-layout>
