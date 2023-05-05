<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate as FacadesGate;
use Termwind\Components\Dd;

class UserController extends Controller
{
    public function index()
    {
        //get id, name, reason, solution, image from penyakit models
        $penyakit = Penyakit::get(['id', 'name', 'reason', 'solution', 'image']);
        $gejala = Gejala::get(['id', 'name']);

        //raw sql
        // $query = DB::raw('SELECT penyakit_id, gejala_id FROM rule');
        // $getQueryResult = DB::select($query);
        // $aturan = [];
        // foreach ($getQueryResult as $key => $value) {
        //     $aturan[$value->penyakit_id][] = $value->gejala_id;
        // }

        //eloquent
        $rule = Rule::get(['penyakit_id', 'gejala_id']);
        $aturan = [];
        foreach ($rule as $key => $value) {
            $aturan[$value->penyakit_id][] = $value->gejala_id;
        }

        $data = [
            'penyakit' => $penyakit,
            'gejala' => $gejala,
            'aturan' => $aturan,
        ];

        return view('user.user', $data);
    }
}
