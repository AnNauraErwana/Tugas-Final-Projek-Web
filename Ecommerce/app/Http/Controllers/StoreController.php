<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $store = Auth::user()->store;  // Assuming the relationship is defined on the User model
        
        // Pass the store to the view
        return view('seller.store.index', compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller.store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $store = new Store();
        $store->user_id = Auth::id();
        $store->name = $request->name;
        $store->description = $request->description;
        $store->image = 'images/'.$imageName;
        $store->save();

        return redirect()->route('seller.store.index')->with('success', 'Store created successfully.');
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
    public function edit($id)
    {
        $store = Store::findOrFail($id);

        // Pastikan hanya pemilik toko yang dapat mengedit
        if (auth()->user()->id !== $store->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('seller.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update kolom lainnya terlebih dahulu
        $store->name = $validatedData['name'];
        $store->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($store->image && file_exists(public_path($store->image))) {
                unlink(public_path($store->image));
            }
            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $store->image = 'images/' . $imageName;
        }

        // Simpan perubahan ke database
        $store->save();

        return redirect()->route('seller.store.index')->with('success', 'Store updated successfully.');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
