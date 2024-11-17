<?php

namespace App\Http\Controllers;

use App\Exceptions\EmptyRajaOngkirAPIException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class KotaProvinsiController extends Controller
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.key');
        if(empty($this->apiKey)) throw new EmptyRajaOngkirAPIException();
    }

    public function indexProvince()
    {
        $cacheKey = 'provinces';
        $cacheTime = 60 * 60 * 24; // Cache for 24 hours

        $provinces = Cache::remember($cacheKey, $cacheTime, function () {
            try {
                $client = new Client();

                $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
                    'headers' => [
                        'key' => $this->apiKey,
                        'content-type' => 'application/x-www-form-urlencoded',
                    ],
                ]);

                $provinces = json_decode($response->getBody())->rajaongkir->results;
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
        $cacheKey = 'cities_'.$id;
        $cacheTime = 60 * 60 * 24; // Cache for 24 hours

        $cities = Cache::remember($cacheKey, $cacheTime, function () use ($id) {
            try {
                $client = new Client();
                $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
                    'headers' => [
                        'key' => $this->apiKey,
                        'content-type' => 'application/x-www-form-urlencoded',
                    ],
                    'query' => [
                        'province' => $id,
                    ],
                ]);

                $cities = json_decode($response->getBody())->rajaongkir->results;
            } catch (GuzzleException $e) {
                Log::debug('Error: ' . json_encode($e->getMessage()));

                $cities = [];
            }

            return $cities;
        });

        return $cities;
    }
}
