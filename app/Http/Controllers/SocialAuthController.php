<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
        }

        $email = (string) ($googleUser->getEmail() ?? '');

        if ($email === '') {
            return redirect()->route('login')->with('error', 'Google account email was not provided.');
        }

        $existing = User::where('email', $email)->first();
        $user = $existing;

        if (! $user) {
            $tempPasswordPlain = Str::password(12);

            $user = User::create([
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                'email' => $email,
                'phone' => null,
                'password' => Hash::make($tempPasswordPlain),
                'usertype' => 'user',
                'google_id' => (string) ($googleUser->getId() ?? ''),
                'auth_provider' => 'google',
                'temp_password' => Crypt::encryptString($tempPasswordPlain),
                'temp_password_created_at' => now(),
            ]);

            $names = preg_split('/\s+/', trim((string) $user->name), 2);

            $user->profile()->create([
                'first_name' => $names[0] ?? null,
                'last_name' => $names[1] ?? null,
                'phone' => null,
            ]);
        } else {
            $needsSave = false;

            if (($user->google_id ?? null) === null && $googleUser->getId()) {
                $user->google_id = (string) $googleUser->getId();
                $needsSave = true;
            }

            if (($user->auth_provider ?? null) === null) {
                $user->auth_provider = 'google';
                $needsSave = true;
            }

            if ($needsSave) {
                $user->save();
            }
        }

        Auth::login($user);
        $request->session()->regenerate();

        if (! $user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
            return redirect()->route('verification.notice');
        }

        return redirect()->route('home');
    }
}

