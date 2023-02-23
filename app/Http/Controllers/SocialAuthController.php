<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Features;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        //get $user from google
        $user = Socialite::driver('google')->user();

        //check user exists in database
        $userFromModel = User::where('email', $user->email)->first();
        if ($user->email == $userFromModel) {
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            $user = User::updateOrCreate([
                'email' => $user->email,
            ], [
                'google_id' => $user->id,
                'name' => $user->name,
                'google_token' => $user->token,
                'google_refresh_token' => $user->refreshToken,
                'email_verified_at' => now(),
                'password' => bcrypt($user->id),
            ]);
            $user->markEmailAsVerified();

            Auth::login($user);
            return redirect()->route('dashboard');
        }
    }
}
