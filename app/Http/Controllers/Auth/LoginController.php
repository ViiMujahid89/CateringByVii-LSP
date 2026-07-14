<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle the login form submission.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password yang Anda masukkan salah.']);
        }

        $user = Auth::user();

        // Check account status for pelanggan role
        if ($user->isPelanggan()) {
            if ($user->isPending()) {
                Auth::logout();

                return redirect()->route('register.pending')
                    ->with('info', 'Akun Anda masih menunggu verifikasi dari admin.');
            }

            if ($user->isRejected()) {
                Auth::logout();

                return redirect()->route('login')
                    ->withErrors(['email' => 'Akun Anda telah ditolak. Silakan hubungi admin untuk informasi lebih lanjut.']);
            }
        }

        $request->session()->regenerate();

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('customer.dashboard'));
    }

    /**
     * Destroy the authenticated session (logout).
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
