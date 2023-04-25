<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Termwind\Components\Dd;

class UserController extends Controller
{
    public function index()
    {
        //get id, name, reason, solution, image from penyakit models
        $penyakit = Penyakit::get(['id', 'name', 'reason', 'solution', 'image']);
        $gejala = Gejala::get(['id', 'name']);
        $data = [
            'penyakit' => $penyakit,
            'gejala' => $gejala,
        ];

        return view('user.user', $data);
    }
}
