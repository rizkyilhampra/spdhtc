<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function beranda()
    {
        $loginDuration = $this->LoginDuration();

        return view('admin.beranda', compact('loginDuration'));
    }

    public function diagnosis()
    {
        return view('admin.diagnosis');
    }

    public function penyakit()
    {
        return view('admin.penyakit');
    }

    public function gejala()
    {
        return view('admin.gejala');
    }

    public function rule()
    {
        return view('admin.rule');
    }
}
