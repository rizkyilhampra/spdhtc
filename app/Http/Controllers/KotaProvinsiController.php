<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class KotaProvinsiController extends Controller
{
    public function indexProvince()
    {
        // Mengambil data provinsi dari API RajaOngkir
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ],
        ]);
        return json_decode($response->getBody())->rajaongkir->results;
    }

    public function indexCity($id)
    {
        // Mengambil data kota dari API RajaOngkir
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ],
            'query' => [
                'province' => $id,
            ],
        ]);
        $kota = json_decode($response->getBody())->rajaongkir->results;
        return response()->json($kota);
    }

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
