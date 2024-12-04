<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $authUserRole = Auth::user()->role;
        if($authUserRole == 'admin'){
            return redirect()->intended(route('admin.dashboard.index', absolute: false));
        }elseif ($authUserRole == 'seller') {
            return redirect()->intended(route('seller.dashboard', absolute: false));
        }elseif($authUserRole == 'buyer'){
            return redirect()->intended(route('buyer.dashboard', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();  // Logout pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect pengguna ke halaman Guest setelah logout
        return redirect()->route('guest');  // Mengarahkan pengguna ke halaman guest
    }
}
