<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\AuthGroupUser;
use App\Models\GoogleAuth;
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
        //get user from google
        $userFromGoogle = Socialite::driver('google')->user();
        //check if user_id exists in users_google_auth table
        $usersGoogleAuth = GoogleAuth::where('google_id', $userFromGoogle->id)->first();
        if ($usersGoogleAuth) {
            //if user_id exists, get user from users table then login
            $users = User::where('id', $usersGoogleAuth->user_id)->first();
            Auth::login($users);
            return redirect()->intended(Fortify::redirects('home'));
        } else {
            //if user_id does not exist, create new user in users table then login
            $users = new User([
                'email' => $userFromGoogle->email,
                'name' => $userFromGoogle->name,
                'email_verified_at' => now(),
                'password' => bcrypt($userFromGoogle->id),
            ]);
            $users->save();
            //create new user_id in users_google_auth table
            $userGoogleAuth = new GoogleAuth([
                'user_id' => $users->id,
                'google_id' => $userFromGoogle->id,
                'avatar' => $userFromGoogle->avatar ?? '',
            ]);
            $users->googleAuth()->save($userGoogleAuth);

            //create new user_id in auth_group_user table
            $authGroupUser = new AuthGroupUser();
            $authGroupUser->fromGoogleAccount($userGoogleAuth);

            $users->markEmailAsVerified();
            Auth::login($users);
            return redirect()->intended(Fortify::redirects('home'));
        }
    }
}
