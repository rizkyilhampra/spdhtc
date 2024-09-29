<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Laravel\Fortify\Fortify;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function authenticated()
    {
        $user = User::find(auth()->user()->id);
        $user->update(['last_login_at' => now()]);

        if (FacadesGate::allows('asAdmin')) {
            return redirect()->intended(Fortify::redirects('home', route('admin.beranda')))->with('success-login-admin');
        } else if (FacadesGate::allows('asUser')) {
            return redirect()->intended(Fortify::redirects('home', route('index')))->with('success', 'Login berhasil, selamat datang ' . $user->name . '!');
        }
        return redirect('/');
    }

    public static function loginDuration()
    {
        $lastLogin = auth()->user()->last_login_at;
        $diffInMinutes = Carbon::parse($lastLogin)->diffInMinutes();

        if ($diffInMinutes < 60) {
            return floor($diffInMinutes) . ' menit';
        }

        if ($diffInMinutes < 1440) {
            $diffInHours = floor($diffInMinutes / 60);
            return $diffInHours . ' jam';
        }

        $diffInDays = floor($diffInMinutes / 1440);
        return $diffInDays . ' hari';
    }
}
