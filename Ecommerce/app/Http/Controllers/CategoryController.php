<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the form to create a new category.
     *
     * 
     */
    public function create()
    {
        return view('categories.create');  
    }

    /**
     * Store a new category in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Create the category
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect back to the product creation page or another route
        return redirect()->route('seller.product.create')->with('success', 'Category created successfully!');
    }
}
