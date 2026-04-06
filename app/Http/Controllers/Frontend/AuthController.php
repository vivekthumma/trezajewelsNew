<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect('/admin/home')
                : redirect('/');
        }
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && !$user->password_set) {
            return redirect()->route('register')
                ->with('info', 'Your email is already in our system from a previous order. Please register to set your password and complete your account.')
                ->withInput(['email' => $request->email]);
        }

        if ($user && $user->isAdmin()) {
            return back()->withErrors([
                'email' => 'Admin account cannot login from the user login page. Please use the admin login.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials + ['type' => User::TYPE_USER])) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin()
                ? redirect('/admin/home')
                : redirect('/');
        }
        return view('frontend.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'agree_terms' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Security: Never allow updating an admin account via public registration
            if ($user->isAdmin()) {
                return back()->withErrors(['email' => 'This email is already associated with an administrator account. Please login.'])->withInput();
            }
            
            // If it's a regular user, we allow updating/claiming the account
            // This handles BOTH guest-to-customer conversion and "loose" re-registration as requested
            $user->update([
                'name' => $request->fname . ' ' . $request->lname,
                'password' => Hash::make($request->password),
                'password_set' => true,
            ]);
        } else {
            // New user
            $user = User::create([
                'name' => $request->fname . ' ' . $request->lname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_set' => true,
                'type' => User::TYPE_USER,
            ]);
        }

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
