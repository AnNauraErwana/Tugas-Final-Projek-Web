<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BuyerProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like',"%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
        }) 
        ->get();

        return view('buyer.dashboard', compact('products'));
    }
}