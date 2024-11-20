<?php

namespace App\Console\Commands;

use App\Http\Controllers\KotaProvinsiController;
use App\Models\UserProfile;
use Illuminate\Console\Command;

class RecachingCities extends Command
{
    protected $signature = 'cache:cities';

    protected $description = 'Recache cities data for chart from RajaOngkir API to local cache';

    public function handle()
    {
        $provinces = UserProfile::select('province')->groupBy('province')->get();

        $request = new \Illuminate\Http\Request;

        foreach ($provinces as $province) {
            (new KotaProvinsiController)->indexCity($request, $province);
        }
    }
}
