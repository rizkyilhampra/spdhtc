<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request as Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function authenticated()
    {
        $user = User::find(auth()->user()->id);
        $user->update(['last_login_at' => now()]);

        if (FacadesGate::allows('asAdmin')) {
            return redirect()->intended(Fortify::redirects('home', route('admin.beranda')));
        } else if (FacadesGate::allows('asUser')) {
            return redirect()->intended(Fortify::redirects('home', route('user.index')));
        } else {
            return redirect('/');
        }
    }
}
