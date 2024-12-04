<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\guestController;


Route::get('/', [guestController::class, 'index'])->name('guest');// Halaman utama untuk guest
Route::get('/search', [guestController::class, 'search'])->name('products.search');  // Route untuk pencarian produk
 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/store/store', [StoreController::class, 'store'])->middleware('auth','role:seller')->name('store.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
