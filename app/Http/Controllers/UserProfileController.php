<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class UserProfileController extends Controller
{
    public function index()
    {

        //get index method from KotaProvinsiController
        $kotaProvinsi = new KotaProvinsiController();
        $provinces = $kotaProvinsi->indexProvince();
        $profession = ['Developer', 'Designer', 'Manager', 'Architect'];

        $data = [
            'user' => User::where('id', auth()->user()->id)->with('profile')->first(),
            'provinsi' => $provinces,
            'profesi' => $profession,
        ];
        return view('user.edit-profile', $data);
    }

    public function update()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'profession' => 'required',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        $user->userProfile->address = $data['address'];
        $user->userProfile->city = $data['city'];
        $user->userProfile->province = $data['province'];
        $user->userProfile->profession = $data['profession'];
        $user->userProfile->save();

        return redirect()->route('dashboard.user')->with('success', 'Profile updated successfully');
    }
}
