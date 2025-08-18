<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KotaProvinsiController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.idn_area.base_url');
    }

    public function indexProvince()
    {
        $cacheKey = 'idn_provinces';
        $cacheTime = 60 * 60 * 24; // Cache for 24 hours

        $provinces = Cache::remember($cacheKey, $cacheTime, function () {
            try {
                $client = new Client();

                $response = $client->request('GET', $this->baseUrl . '/provinces', [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                
                // Transform IDN Area API response to match rajaongkir format
                $provinces = collect($data['data'])->map(function ($province) {
                    return (object) [
                        'province_id' => $province['code'],
                        'province' => $province['name']
                    ];
                })->toArray();
                
            } catch (GuzzleException $e) {
                Log::debug('Error: ' . json_encode($e->getMessage()));

                $provinces = [];
            }
            return $provinces;
        });

        return $provinces;
    }

    public function indexCity(Request $request, $id)
    {
        $cacheKey = 'idn_regencies_'.$id;
        $cacheTime = 60 * 60 * 24; // Cache for 24 hours

        $cities = Cache::remember($cacheKey, $cacheTime, function () use ($id) {
            try {
                $client = new Client();
                $response = $client->request('GET', $this->baseUrl . '/regencies', [
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'query' => [
                        'provinceCode' => $id,
                    ],
                ]);

                $data = json_decode($response->getBody(), true);
                
                // Transform IDN Area API response to match rajaongkir format
                $cities = collect($data['data'])->map(function ($regency) {
                    return (object) [
                        'city_id' => $regency['code'],
                        'city_name' => $regency['name'],
                        'province_id' => $regency['provinceCode']
                    ];
                })->toArray();
                
            } catch (GuzzleException $e) {
                Log::debug('Error: ' . json_encode($e->getMessage()));

                $cities = [];
            }

            return $cities;
        });

        return $cities;
    }
}
