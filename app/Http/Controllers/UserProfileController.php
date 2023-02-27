<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Termwind\Components\Dd;

class UserProfileController extends Controller
{
    public function edit()
    {
        //get user where id = 11 and retun to view
        $user = \App\Models\User::find(12);
        //get index method from KotaProvinsiController
        $kotaProvinsi = new KotaProvinsiController();
        $provinces = $kotaProvinsi->indexProvince();


        $data = [
            'user' => $user,
            'provinsi' => $provinces,
        ];
        return view('user.edit-profile', $data);
    }
}
