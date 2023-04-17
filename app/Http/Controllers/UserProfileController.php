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
        $profession = [
            'Petani',
            'Lainnya',
        ];

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

            // Update user data
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();

            // Update or create user profile
            if (!$user->profile) {
                $profile = new UserProfile();
                $profile->user_id = $user->id;
            } else {
                $profile = $user->profile;
            }

            $profile->address = $data['address'];
            $profile->city = $data['city'];
            $profile->province = $data['province'];
            $profile->profession = $data['profession'];
            $profile->save();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->route('edit-profile')->with('error', 'Profile failed to update');
        }
        return redirect()->route('edit-profile')->with('success', 'Profile updated successfully');
    }
}
