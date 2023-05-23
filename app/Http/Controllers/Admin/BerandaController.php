<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\KotaProvinsiController;
use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request as HttpRequest;

class BerandaController extends Controller
{
    public function index()
    {
        $data = [
            'loginDuration' => $this->LoginDuration(),
            'jumlahPengguna' => $this->jumlahPengguna(),
            'jumlahPenyakit' => $this->jumlahPenyakit(),
            'jumlahGejala' => $this->jumlahGejala(),
            'jumlahDiagnosis' => $this->jumlahDiagnosis(),
            'chartProvince' => $this->chartProvince(),
            'chartCity' => $this->chartCity(),
            'chartProfession' => $this->chartProfession(),
            'diagnosisPenyakit' => $this->diagnosisPenyakit(),
        ];

        return view('admin.beranda', $data);
    }

    public function jumlahPengguna()
    {
        $jumlahPengguna = User::count();
        return $jumlahPengguna;
    }

    public function jumlahPenyakit()
    {
        $jumlahPenyakit = Penyakit::count();
        return $jumlahPenyakit;
    }

    public function jumlahGejala()
    {
        $jumlahGejala = Gejala::count();
        return $jumlahGejala;
    }

    public function jumlahDiagnosis()
    {
        $jumlahDiagnosis = Diagnosis::count();
        return $jumlahDiagnosis;
    }

    public function chartProvince()
    {
        $data = UserProfile::selectRaw('count(*) as count, province')
            ->groupBy('province')
            ->get()->toArray();
        $indexProvince = new KotaProvinsiController();
        $provinces = $indexProvince->indexProvince();
        $provinces = json_decode(json_encode($provinces), true);

        $province = [];
        foreach ($provinces as $key => $value) {
            $province[$value['province_id']] = [
                'province' => $value['province'],
            ];
        }

        $data = array_map(function ($item) use ($province) {
            $item['province'] = $province[$item['province']]['province'] ?? null;
            return $item;
        }, $data);

        return $data;
    }

    public function chartCity()
    {
        $data = UserProfile::selectRaw('count(*) as count, city')->groupBy('city')->get()->toArray();

        $userProfileCity = array_column($data, 'city'); // Mengambil semua id dari hasil query
        $userProfiles = UserProfile::whereIn('city', $userProfileCity)->get('province')->toArray();
        $indexCity = new KotaProvinsiController();

        $request = new HttpRequest();

        $cities = [];
        foreach ($userProfiles as $key => $value) {
            $value['province'] = $indexCity->indexCity($request, $value['province']);
            $value['province'] = json_decode(json_encode($value['province']), true);
            foreach ($value['province'] as $key2 => $value2) {
                $cities[$value2['city_id']] = [
                    'city' => $value2['city_name'],
                ];
            }
        }
        $data = array_map(function ($item) use ($cities) {
            $item['city'] = $cities[$item['city']]['city'] ?? null;
            return $item;
        }, $data);

        return $data;
    }

    public function chartProfession()
    {
        $data = UserProfile::selectRaw('count(*) as count, profession')->groupBy('profession')->get()->toArray();
        return $data;
    }

    public function diagnosisPenyakit()
    {
        $data = Diagnosis::selectRaw('count(*) as count, penyakit_id')->groupBy('penyakit_id')->get()->toArray();
        $penyakit = Penyakit::get(['id', 'name'])->toArray();
        $penyakit = array_column($penyakit, 'name', 'id');
        $data = array_map(function ($item) use ($penyakit) {
            $item['penyakit'] = $penyakit[$item['penyakit_id']] ?? null;
            return $item;
        }, $data);
        return $data;
    }
}
