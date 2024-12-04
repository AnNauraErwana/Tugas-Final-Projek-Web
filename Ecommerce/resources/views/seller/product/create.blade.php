<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    @php
        $store = Auth::user()->store;
    @endphp

    @if ($store)
        <div class="max-w-3xl mx-auto mt-10 mb-10 p-8 bg-white shadow-md rounded">
            <form action="{{ route('seller.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required value="{{ old('name') }}">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required value="{{ old('price') }}">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required value="{{ old('stock') }}">
                    @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <div class="flex items-center">
                        <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('categories.create') }}" class="ml-4 inline-block px-4 py-2 text-black bg-yellow-300 hover:bg-yellow-200 rounded-lg shadow-md transition duration-300">Add</a>
                    </div>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <a href="{{ route('seller.product.index') }}" class="px-6 py-3 mt-4 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition duration-300">Back</a>
                <button type="submit" class="px-6 py-2 mt-4 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300">Save Product</button>
            </form>
        </div>
    @else
        <div class="max-w-3xl mx-auto mt-10 mb-10 p-8 bg-gray-100 shadow-md rounded">
            <p class="text-center text-gray-700">You don't have a store yet. Please create a store first.</p>
            <a href="{{ route('seller.store.create') }}" class="block text-center px-6 py-2 mt-4 bg-brown text-white font-semibold rounded-lg shadow-md hover:bg-brown2 transition duration-300">
                Create Your Store
            </a>
        </div>
    @endif
</x-app-layout>
