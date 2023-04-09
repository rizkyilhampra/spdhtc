<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function updateUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'profession' => 'required',
        ]);

        //try catch example
        try {
            $user = User::find(auth()->user()->id);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();

            $userProfile = new UserProfile();
            $userProfile->user_id = $user->id;
            $userProfile->address = $data['address'];
            $userProfile->city = $data['city'];
            $userProfile->province = $data['province'];
            $userProfile->profession = $data['profession'];
            $userProfile->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('edit-profile')->with('error', 'Profile failed to update');
        }
        return redirect()->route('edit-profile')->with('success', 'Profile updated successfully');
    }
}
