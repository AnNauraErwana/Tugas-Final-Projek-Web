<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Favorites') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-10">
        @if ($favorites->isEmpty())
            <p class="text-center text-gray-500">You have no favorite products yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($favorites as $favorite)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <img src="{{ asset($favorite->product->image) }}" alt="{{ $favorite->product->name }}" class="w-full h-48 object-cover rounded-lg">
                        <h3 class="mt-4 text-lg font-semibold text-gray-800">{{ $favorite->product->name }}</h3>
                        <p class="text-gray-600">{{ number_format($favorite->product->price, 2) }}</p>

                        <div class="mt-4">
                            <!-- Add to Cart Button -->
                            <form action="{{ route('buyer.cart.store', $favorite->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
