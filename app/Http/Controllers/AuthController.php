<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new \Illuminate\Auth\Events\Registered($user));

        Auth::login($user);

        return redirect()->intended('dashboard')
            ->with('success', 'Account created successfully! Please verify your email.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')
                ->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'You have been logged out successfully.');
    }

    // Google Auth Methods
    public function redirectToGoogle()
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => null, // Password is null for Google users
                    'email_verified_at' => now(), // Google emails are trusted
                ]);
            } else {
                // If user exists but doesn't have google_id, update it
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);

                    if (!$user->hasVerifiedEmail()) {
                        $user->markEmailAsVerified();
                    }
                }
            }

            Auth::login($user);

            return redirect()->intended('dashboard')
                ->with('success', 'Successfully logged in with Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Unable to login with Google. Please try again.']);
        }
    }

    // Email Verification Methods
    public function verifyEmail(\Illuminate\Foundation\Auth\EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('dashboard')
            ->with('success', 'Email verified successfully!');
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }
}
