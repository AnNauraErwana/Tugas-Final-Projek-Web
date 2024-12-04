<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stores Management') }}
        </h2>
    </x-slot>

    @if ($stores->isEmpty())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded">
                        <p>No stores available. Please create a store to manage products.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach ($stores as $store)
            <div class="p-6 bg-white border-b border-gray-200 mb-6">
                <!-- Store Information -->
                <h3 class="text-xl font-semibold">{{ $store->name }}</h3>
                <form action="{{ route('admin.store.destroy', $store->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this store?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-600">Delete Store</button>
                </form>

                <!-- Products List -->
                <h4 class="mt-4 text-lg font-medium">Products:</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($store->products as $product)
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <!-- Display Product Image -->
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded">

                            <!-- Product Info -->
                            <div class="flex justify-between items-center">
                                <div>
                                    <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                                    <p class="text-sm text-gray-500">${{ $product->price }}</p>
                                </div>
                                <form action="{{ route('admin.dashboard.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</x-app-layout>
