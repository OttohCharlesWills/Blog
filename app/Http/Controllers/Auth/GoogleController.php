<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Use stateless() for localhost or testing
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if user exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(16)), // random password
                'role' => 'blogger',
                'is_active' => true,
                'onboarding_completed' => false,
                'email_verified_at' => now(), // skip email verification for Google
            ]);
        }

        Auth::login($user, true);

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended('/home');
    }
}
