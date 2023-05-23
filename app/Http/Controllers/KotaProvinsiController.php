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
                $provinces = [];
            }

            return $provinces;
        });

        return $provinces;

        // // Mengambil data provinsi dari API RajaOngkir
        // $client = new Client();
        // $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
        //     'headers' => [
        //         'key' => env('RAJAONGKIR_API_KEY'),
        //         'content-type' => 'application/x-www-form-urlencoded'
        //     ],
        // ]);
        // return json_decode($response->getBody())->rajaongkir->results;
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
                $cities = [];
            }

            return $cities;
        });

        return $cities;
    }

    // public function indexCity($id)
    // {
    //     // Mengambil data kota dari API RajaOngkir
    //     $client = new Client();
    //     $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
    //         'headers' => [
    //             'key' => env('RAJAONGKIR_API_KEY'),
    //             'content-type' => 'application/x-www-form-urlencoded'
    //         ],
    //         'query' => [
    //             'province' => $id,
    //         ],
    //     ]);
    //     $kota = json_decode($response->getBody())->rajaongkir->results;
    //     return response()->json($kota);
    // }

    // public function store(Request $request)
    // {
    //     // Menyimpan data kota yang dipilih ke dalam database
    //     $kota = new Kota;
    //     $kota->nama_kota = $request->input('kota');
    //     $kota->kode_kota = $request->input('kode_kota');
    //     $kota->id_provinsi = $request->input('provinsi');
    //     $kota->save();

    //     return redirect()->back()->with('success', 'Data kota berhasil disimpan.');
    // }
}
