<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Gejala;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function Diagnosis(Request $request)
    {
        $allGejala = Gejala::select('id')->count();

        $request->validate([
            'idgejala' => ['required', 'numeric', 'max:' . $allGejala, 'min:1'],
            'value' => ['required', 'boolean'],
        ]);

        $fakta = [
            $request->idgejala => $request->value
        ];

        $modelDiagnosis = Diagnosis::firstOrNew(['user_id' => auth()->user()->id]);
        $decodeAnswerLog = json_decode($modelDiagnosis->answer_log, true) ?? [];
        $answerLog = $decodeAnswerLog + $fakta;
        $modelDiagnosis->answer_log = json_encode($answerLog);
        $modelDiagnosis->save();

        return response()->json($modelDiagnosis->answer_log);
    }
}
