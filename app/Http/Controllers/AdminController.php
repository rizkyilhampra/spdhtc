<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $lastLogin = auth()->user()->last_login_at;
        $loginDuration = Carbon::parse($lastLogin)->diffInMinutes();

        return view('admin.dashboard', compact('loginDuration'));
    }
}
