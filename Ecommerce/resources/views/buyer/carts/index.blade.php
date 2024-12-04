<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-10">
        @if ($carts->isEmpty())
            <p class="text-center text-gray-500">Your cart is empty.</p>
            <a href="{{ route('buyer.products.index') }}" class="inline-block px-6 py-2 mt-4 bg-brown text-white font-semibold rounded-lg shadow-md hover:bg-brown2 transition duration-300">
                Browse Products
            </a>
        @else
            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Product</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Price</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Quantity</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Total</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td class="px-6 py-4">{{ $cart->product->name }}</td>
                                <td class="px-6 py-4">{{ number_format($cart->product->price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('buyer.cart.update', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" class="w-16 border rounded-md">
                                        <button type="submit" class="ml-2 text-green-500">Update</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4">{{ number_format($cart->quantity * $cart->product->price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('buyer.cart.remove', $cart->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('buyer.products.index') }}" class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Continue Shopping
                    </a>

                    <div class="text-right">
                        <p class="text-xl font-semibold">Total: {{ number_format($carts->sum(function ($cart) {
                            return $cart->quantity * $cart->product->price;
                        }), 2) }}</p>
                        
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
