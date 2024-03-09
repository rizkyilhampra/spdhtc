<?php

namespace App\Http\Controllers;

use App\Models\AuthGroupUser;
use App\Models\GoogleAuth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Fortify;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        //try get user from google
        try {
            $userFromGoogle = Socialite::driver('google')->user();
        } catch (Exception $th) {
            //return 500 Internal Server Error
            Log::error($th);
            abort(500, 'Terjadi kesalahan saat mengambil data dari Google. Silahkan coba beberapa saat lagi. Jika masalah terus berlanjut, hubungi Administrator/Pengembang');
        }
        //check if user_id exists in users_google_auth table
        $usersGoogleAuth = GoogleAuth::where('google_id', $userFromGoogle->id)->first();
        //check if email from google exists in users table
        $userEmail = User::where('email', $userFromGoogle->email)->first();

        if ($usersGoogleAuth) {
            //if user_id exists, get user from users table then login
            $users = User::where('id', $usersGoogleAuth->user_id)->first();
            Auth::login($users);
            return redirect()->intended(Fortify::redirects('home'));
        } else if ($userEmail) {
            //return 409 Conflict
            abort(409, 'Email Google anda sudah terdaftar. Silahkan masuk menggunakan email dan kata sandi anda atau gunakan email lain untuk masuk menggunakan Google.');
        }

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
