<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Store;


class AdminProductController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $userCount = User::count();
        $storeCount = Store::count();

        return view('admin.dashboard', compact('productCount', 'userCount', 'storeCount'));
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        // Delete the product
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }

}
