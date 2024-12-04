<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class AdminStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
    
        // Fetch all stores with their products
        $stores = Store::with('products') // Eager load products
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
            })
            ->get(); // Get all stores
    
        return view('admin.stores.index', compact('stores'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroyProduct(string $id)
    {
        $product = Product::findOrFail($id);
        
        // Delete the product
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = Store::findOrFail($id);
        
        // Delete the store (this will also delete associated products if set up with cascading)
        $store->delete();
    
        return redirect()->route('admin.store.index')->with('success', 'Store deleted successfully.');
    }
}
