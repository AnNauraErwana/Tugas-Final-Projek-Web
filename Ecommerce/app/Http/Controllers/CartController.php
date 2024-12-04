<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->cart;
        return view('buyer.carts.index', compact('carts'));
    }

    public function store(Product $product)
    {
        $user = auth()->user();
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, $id)
    {
        $cart = auth()->user()->cart()->findOrFail($id);
        $cart->update($request->all());
        return back()->with('success', 'Cart updated!');
    }

    public function destroy($id)
    {
        auth()->user()->cart()->findOrFail($id)->delete();
        return back()->with('success', 'Product removed from cart!');
    }
}
