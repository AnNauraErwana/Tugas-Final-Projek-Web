<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    @php
        $store = Auth::user()->store;
    @endphp

    @if ($store)
        <div class="max-w-7xl mx-auto mt-10 mb-10 p-8 bg-gradient-to-r from-brown2 via-white to-brown2 shadow-lg rounded-lg">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-semibold text-gray-800">
                    Products in Your Store: <span class="text-black">{{ $store->name }}</span>
                </h3>
                <a href="{{ route('seller.product.create') }}" 
                    class="px-6 py-2 bg-brown text-white font-semibold rounded-lg shadow hover:bg-brown2 transition duration-300">
                    Add New Product
                </a>
            </div>
            
            @if($products->isEmpty())
                <p class="text-center text-gray-500 italic">You have no products yet.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                            <img src="{{ asset($product->image)}}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h4>
                            <p class="text-sm text-gray-600 mb-2">Category: {{ $product->category->name }}</p>
                            <p class="text-sm text-gray-600 mb-2">Price: ${{ $product->price }}</p>
                            <p class="text-sm text-gray-600 mb-4">Stock: {{ $product->stock }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('seller.product.edit', $product->id) }}" 
                                    class="text-yellow-500 hover:text-yellow-600 font-semibold">Edit</a>
                                <form action="{{ route('seller.product.destroy', $product->id) }}" method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-600 font-semibold">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="max-w-3xl mx-auto mt-10 p-8 bg-red-50 border-l-4 border-red-400 text-red-700 shadow-lg rounded-lg">
            <p class="text-center text-lg font-medium">You don't have a store yet.</p>
            <a href="{{ route('seller.store.create') }}" 
               class="block text-center px-6 py-2 mt-4 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 transition duration-300">
                Create Your Store
            </a>
        </div>
    @endif
</x-app-layout>
