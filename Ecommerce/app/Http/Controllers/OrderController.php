<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders;
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $order = auth()->user()->orders()->create($request->all());
        // Logic for processing payment and order details
        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function destroy($id)
    {
        auth()->user()->orders()->findOrFail($id)->delete();
        return back()->with('success', 'Order cancelled!');
    }
}
