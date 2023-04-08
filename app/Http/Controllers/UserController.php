<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;


class UserController extends Controller
{
    public function index()
    {
        //get id, name, reason, solution, image from penyakit models
        $penyakit = Penyakit::get(['id', 'name', 'reason', 'solution', 'image']);

        return view('user.user', compact('penyakit'));
    }

    public function diagnosis()
    {
        return view('user.diagnosis');
    }
}
