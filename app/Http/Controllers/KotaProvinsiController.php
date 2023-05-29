<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class KotaProvinsiController extends Controller
{
    public function indexProvince()
    {
        $cacheKey = 'provinces';
        $cacheTime = 60 * 60 * 24; // Cache for 24 hours

        $provinces = Cache::remember($cacheKey, $cacheTime, function () {
            try {
                $client = new Client();
                $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
                    'headers' => [
                        'key' => env('RAJAONGKIR_API_KEY'),
                        'content-type' => 'application/x-www-form-urlencoded'
                    ],
                ]);

                $provinces = json_decode($response->getBody())->rajaongkir->results;
            } catch (GuzzleException $e) {
                // Handle any exception from Guzzle
                $provinces = [$e->getMessage()];
            }

            return $provinces;
        });

        return $provinces;
    }

    public function indexCity(Request $request, $id)
    {
        $cacheKey = 'cities_' . $id;
        $cacheTime = 60 * 60 * 24; // Cache for 24 hours

        $cities = Cache::remember($cacheKey, $cacheTime, function () use ($id) {
            try {
                $client = new Client();
                $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
                    'headers' => [
                        'key' => env('RAJAONGKIR_API_KEY'),
                        'content-type' => 'application/x-www-form-urlencoded'
                    ],
                    'query' => [
                        'province' => $id,
                    ],
                ]);

                $cities = json_decode($response->getBody())->rajaongkir->results;
            } catch (GuzzleException $e) {
                // Handle any exception from Guzzle
                $cities = [$e->getMessage()];
            }

            return $cities;
        });

        return $cities;
    }
}
