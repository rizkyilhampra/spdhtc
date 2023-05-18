<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\User;
use Carbon\Carbon;
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

        $data = [
            'penyakit' => $penyakit,
            'gejala' => $gejala,
        ];

        return view('user.user', $data);
    }

    public function historiDiagnosis(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Forbidden');
        }

        $user = auth()->user();

        $historiDiagnosis = Diagnosis::where('user_id', $user->id ?? null)->get(['id', 'created_at', 'penyakit_id']);
        $data = $historiDiagnosis->map(function ($item) {
            $item->penyakit = Penyakit::find($item->penyakit_id, ['name']) ?? ['name' => 'Tidak Diketahui'];
            return $item;
        });

        return response()->json([
            'data' => $data,
        ]);
    }
}
