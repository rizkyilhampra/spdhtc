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

        $diagnosisCheck = Diagnosis::where('user_id', auth()->user()->id)->get()->last();
        if ($diagnosisCheck == null) {
            $modelDiagnosis = new Diagnosis();
            $modelDiagnosis->user_id = auth()->user()->id;
        } else if ($diagnosisCheck->penyakit_id == null) {
            $maxAnswerlog = max(array_keys(json_decode($diagnosisCheck->answer_log, true) ?? []));
            if ($maxAnswerlog == $allGejala) {
                $modelDiagnosis = new Diagnosis();
                $modelDiagnosis->user_id = auth()->user()->id;
            } else {
                $modelDiagnosis = $diagnosisCheck;
            }
        } else if ($diagnosisCheck->penyakit_id != null) {
            $modelDiagnosis = new Diagnosis();
            $modelDiagnosis->user_id = auth()->user()->id;
        }
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
                $penyakit = Penyakit::find($modelDiagnosis->penyakit_id)->get(['name', 'reason', 'solution', 'image'])->first();
                $terdeteksi = true;
            }
        }

        // Tidak ada penyakit yang terdeteksi
        if (!$terdeteksi && $request->idgejala == $allGejala) {
            return response()->json(['penyakitUndentified' => 'Tidak ada penyakit yang cocok dengan gejala yang anda masukkan.']);
        }

        return response()->json([
            $modelDiagnosis->answer_log,
            $penyakit ?? null
        ]);
    }

    // public function result()
    // {
    //     $diagnosisCheck = Diagnosis::where('user_id', auth()->user()->id)->get()->last();
    //     $maxAnswerlog = max(array_keys(json_decode($diagnosisCheck->answer_log, true) ?? []));
    //     dd($maxAnswerlog);
    // }
}
