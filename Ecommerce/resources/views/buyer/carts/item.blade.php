{{-- resources/views/buyer/cart/item.blade.php --}}
<tr>
    <td class="px-6 py-4">{{ $cart->product->name }}</td>
    <td class="px-6 py-4">{{ number_format($cart->product->price, 2) }}</td>
    <td class="px-6 py-4">{{ $cart->quantity }}</td>
    <td class="px-6 py-4">{{ number_format($cart->quantity * $cart->product->price, 2) }}</td>
    <td class="px-6 py-4">
        <form action="{{ route('buyer.cart.remove', $cart->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">Remove</button>
        </form>
    </td>
</tr>
