<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // definition remember
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // add untuk remember me, jika checkbox remember me dicentang maka session akan bertahan selama 7 hari
            // function remember()
            if ($remember) {
                // 7 hari dalam menit = 10080
                config(['session.lifetime' => 10080]);
                $request->session()->put('expires_at', now()->addDays(7));
            } else {
                // 3 hari dalam menit = 4320 (sudah default di session.php)
                $request->session()->put('expires_at', now()->addDays(3));
            }

            // Redirect berdasarkan role
            if (Auth::user()->isAdmin()) {
                return redirect()->route('backoffice.index');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('dashboard');
    }
}
