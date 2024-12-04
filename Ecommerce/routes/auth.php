<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;   
use App\Http\Controllers\AdminStoreController;   
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminProductController;
use App\Models\Product;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BuyerProductController;



Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/admin/dashboard', function () {
            return view('admin/dashboard');
        })->middleware('role:admin')->name('admin.dashboard');

    Route::middleware(['role:admin'])->prefix('admin')->as('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('dashboard', AdminProductController::class);
        Route::get('stores', [AdminStoreController::class, 'index'])->name('stores.index');
        Route::delete('admin/stores/{id}', [AdminStoreController::class, 'destroy'])->name('store.destroy');
        
    });
    
    Route::middleware(['role:seller'])->group(function () {
        Route::get('/seller/dashboard', function () {
            return view('seller.dashboard');
        })->name('seller.dashboard');
    
        Route::get('/seller/store/create', [StoreController::class, 'create'])->name('seller.store.create');
        Route::post('/seller/store/store',[StoreController::class, 'store'])->name('store.store');
        Route::get('/seller/store/index',[StoreController::class, 'index'])->name('seller.store.index');
        Route::get('/seller/store/edit/{id}', [StoreController::class, 'edit'])->name('seller.store.edit');
        Route::put('/seller/store/update/{id}', [StoreController::class, 'update'])->name('seller.store.update');

        Route::get('/seller/products', [ProductController::class, 'index'])->name('seller.product.index');
        Route::get('/seller/products/create', [ProductController::class, 'create'])->name('seller.product.create');
        Route::post('/seller/products/store', [ProductController::class, 'store'])->name('seller.product.store');
        Route::get('/seller/product/edit/{id}', [ProductController::class, 'edit'])->name('seller.product.edit');
        Route::put('/seller/product/update/{id}', [ProductController::class, 'update'])->name('seller.product.update');
        Route::delete('/seller/product/{id}', [ProductController::class, 'destroy'])->name('seller.product.destroy');

        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    });

    Route::get('/buyer/dashboard', function () {
            $products = Product::all(); // Mengambil semua data produk
            return view('buyer/dashboard',compact('products'));
        })->middleware('role:buyer')->name('buyer.dashboard');

        
    Route::middleware(['role:buyer'])->prefix('buyer')->as('buyer.')->group(function () {
        Route::get('cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('favorites/{product}', [FavoriteController::class, 'store'])->name('favorites.store');
        Route::post('favorites/index', [FavoriteController::class, 'index'])->name('favorite.index');
        Route::post('cart/{product}', [CartController::class, 'store'])->name('cart.store');
        Route::patch('cart/{id}/', [CartController::class, 'update'])->name('cart.update');
        Route::delete('cart/{id}/', [CartController::class, 'destroy'])->name('cart.remove');
        Route::get('buyer/products', [BuyerProductController::class, 'index'])->name('products.index');
    });

});
