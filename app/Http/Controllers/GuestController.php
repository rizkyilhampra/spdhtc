<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __invoke(Request $request)
    {
        return redirect()->route('admin.beranda')->with('success-login-admin');
    }
}
