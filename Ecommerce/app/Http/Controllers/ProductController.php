<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store = Auth::user()->store;
        if ($store) {
            $products = $store->products()->paginate(5);  // Get the products for the store
            return view('seller.product.index', compact('products'));
        } else {
            return view('seller.product.create')->with('error', 'You must create a store first.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('seller.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Mendapatkan store milik user yang sedang login
        $store = Auth::user()->store;
    
        if (!$store) {
            return redirect()->back()->with('error', 'You must own a store to add products.');
        }
    
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('imageProducts'), $imageName);
            $imagePath = 'imageProducts/' . $imageName;
        }
    
        // Menambahkan produk baru
        $store->products()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('seller.product.index')->with('success', 'Product added successfully!');
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
        // Retrieve the store associated with the authenticated user
        $store = Auth::user()->store;
        $product = $store->products()->findOrFail($id);
        $categories = Category::all();
        return view('seller.product.edit', compact('product', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $store = Auth::user()->store;
        $product = $store->products()->findOrFail($id);  // Pastikan produk sesuai dengan store user

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            // Save new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('imageProducts'), $imageName);
            $product->image = 'imageProducts/' . $imageName;
        }

        // Update product data
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('seller.product.index')->with('success', 'Product updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);  // Find the product by ID

        // Delete the product image from the server if it exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));  // Remove the image file
        }

        // Delete the product record from the database
        $product->delete();

        return redirect()->route('seller.product.index')->with('success', 'Product deleted successfully!');
    }

}
