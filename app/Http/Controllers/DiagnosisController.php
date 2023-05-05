<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function Diagnosis(Request $request)
    {
        $allGejala = Gejala::get('id')->count();

        $request->validate([
            'idgejala' => ['required', 'numeric', 'max:' . $allGejala, 'min:1'],
        ]);

        $requestFakta = [
            $request->idgejala => filter_var($request->value, FILTER_VALIDATE_BOOLEAN)
        ];

        $modelDiagnosis = Diagnosis::firstOrNew(['user_id' => auth()->user()->id]);
        $decodeAnswerLog = json_decode($modelDiagnosis->answer_log, true) ?? [];
        $answerLog = $decodeAnswerLog + $requestFakta;
        $modelDiagnosis->answer_log = json_encode($answerLog);
        $modelDiagnosis->save();

        //Aturan
        $rule = Rule::get(['penyakit_id', 'gejala_id']);
        $aturan = [];
        foreach ($rule as $key => $value) {
            $aturan[$value->penyakit_id][] = $value->gejala_id;
        }

        //Basis Fakta
        $fakta = $answerLog;

        //Inferensi
        $terdeteksi = false;
        foreach ($aturan as $penyakitId => $gejala) {
            $apakahPenyakit = true;
            foreach ($gejala as $gejalaPenyakit) {
                $fakta[$gejalaPenyakit] = $fakta[$gejalaPenyakit] ?? false;
                if (!$fakta[$gejalaPenyakit]) {
                    $apakahPenyakit = false;
                    break;
                }
            }
            if ($apakahPenyakit) {
                if ($modelDiagnosis->penyakit_id == null) {
                    $modelDiagnosis->penyakit_id = $penyakitId;
                    $modelDiagnosis->save();
                }
                $penyakit = Penyakit::find($modelDiagnosis->penyakit_id);
                $penyakitName = $penyakit->name;
                $terdeteksi = true;
            }
        }

        // Tidak ada penyakit yang terdeteksi
        if (!$terdeteksi) {
            // echo "Tidak dapat mendeteksi penyakit yang dialami pasien<br>";
            // return response()->json(['message' => 'Tidak ada penyakit yang cocok dengan gejala yang anda masukkan.']);
        }

        // if ($modelDiagnosis->penyakit_id != null) {
        //     $penyakit = Penyakit::find($modelDiagnosis->penyakit_id);
        //     return response()->json($penyakit->name);
        // }

        return response()->json([
            $modelDiagnosis->answer_log,
            $penyakitName ?? null
        ]);
    }
}
