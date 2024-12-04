<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite; // Menyertakan model Favorite
 

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites;
        return view('favorite.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $user->favorites()->attach($product);
        return back()->with('success', 'Product added to favorites.');
    }

    public function destroy($id)
    {
        auth()->user()->favorites()->detach($id);
        return back()->with('success', 'Product removed from favorites!');
    }
}


