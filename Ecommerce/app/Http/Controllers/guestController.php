<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class guestController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Menampilkan 10 produk per halaman
        return view('welcome', compact('products'));
    }

    // Mencari produk berdasarkan nama
    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('name', 'LIKE', "%{$search}%")->paginate(10);
        return view('welcome', compact('products', 'search'));
    }
}
