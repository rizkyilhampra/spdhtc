<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use App\Models\User;
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

    // public function editProfile()
    // {
    //     //get index method from KotaProvinsiController
    //     $kotaProvinsi = new KotaProvinsiController();
    //     $provinces = $kotaProvinsi->indexProvince();
    //     $profession = [
    //         'Petani',
    //         'Lainnya',
    //     ];

    //     $data = [
    //         'user' => User::where('id', auth()->user()->id)->with('profile')->first(),
    //         'provinsi' => $provinces,
    //         'profesi' => $profession,
    //     ];

    //     return response()->json($data);
    // }
}
