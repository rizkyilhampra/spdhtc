<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::get(['id', 'name', 'reason', 'solution', 'image']);

        return view('user.user', compact('penyakit'));
    }


    public function historiDiagnosis(Request $request)
    {
        if ($request->isMethod('delete')) {
            $diagnosis = Diagnosis::find($request->id);
            $diagnosis->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data',
            ]);
        }

        $user = auth()->user();

        $query = Diagnosis::with(['penyakit' => function ($query) {
            $query->select('id', 'name');
        }])->where('user_id', $user->id ?? null);

        if ($request->has('search.value')) {
            $searchValue = $request->input('search.value');
            $query->where(function ($q) use ($searchValue) {
                $q->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%')
                    ->orWhereHas('penyakit', function ($q) use ($searchValue) {
                        $q->where('name', 'like', '%' . $searchValue . '%');
                    });
            });
        }

        $totalData = $query->count();

        $start = $request->input('start', 0);
        $length = $request->input('length', 5);

        $orderColumn = $request->input('order.0.column', 0);
        $orderDirection = $request->input('order.0.dir', 'asc');

        $orderColumns = [
            0 => 'id',
            1 => 'created_at',
        ];

        if (array_key_exists($orderColumn, $orderColumns)) {
            $orderBy = $orderColumns[$orderColumn];
            $query->orderBy($orderBy, $orderDirection);

            $no = ($orderDirection == 'asc') ? $totalData - $start : $start + 1;
        }

        $historiDiagnosis = $query
            ->offset($start)
            ->limit($length)
            ->get(['id', 'created_at', 'penyakit_id']);

        $data = $historiDiagnosis->map(function ($item) use (&$no, $orderDirection) {
            $penyakit = Penyakit::find($item->penyakit_id, ['name']);
            $item->penyakit = $penyakit ? $penyakit->name : 'Tidak Diketahui';
            $item->no = ($orderDirection == 'asc') ? $no-- : $no++;
            return $item;
        });

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ]);
    }

    public function detailDiagnosis(Request $request)
    {
        $penyakit = Penyakit::find(
            Diagnosis::find($request->id_diagnosis, ['penyakit_id'])->penyakit_id,
            ['name', 'reason', 'solution', 'image']
        );

        $diagnosis = Diagnosis::find($request->id_diagnosis, ['answer_log']);
        $answerLog = json_decode($diagnosis->answer_log, true);
        foreach ($answerLog as $key => $value) {
            $answerLog[$key] = $value == 1 ? 'Ya' : 'Tidak';
        }
        $gejala = Gejala::whereIn('id', array_keys($answerLog))->get(['id', 'name']);
        foreach ($gejala as $item) {
            $item->answer = $answerLog[$item->id];
        }
        $answerLog = $gejala->map(function ($item) use ($request) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'answer' => $item->answer,
            ];
        });

        return response()->json(
            [
                'penyakit' => $penyakit,
                'answerLog' => $answerLog,
            ]
        );
    }

    public function getGejala()
    {
        $gejala = Gejala::get(['id', 'name', 'image']);
        return response()->json($gejala);
    }


    public function chartDiagnosisPenyakit(Request $request)
    {
        // Mengumpulkan aturan-aturan berdasarkan penyakit dan gejala
        $rule = Rule::get(['penyakit_id', 'gejala_id']);
        $aturan = [];
        foreach ($rule as $value) {
            $aturan[$value->penyakit_id][] = $value->gejala_id;
        }

        // Mendapatkan data diagnosis dan log jawaban
        $diagnosis = Diagnosis::find($request->id_diagnosis, ['answer_log']);
        $answerLog = json_decode($diagnosis->answer_log, true);

        // Menghitung bobot untuk setiap penyakit
        $bobot = [];
        foreach ($aturan as $idPenyakit => $idGejala) {
            $bobot[$idPenyakit] = 0;
            foreach ($answerLog as $key => $value) {
                if (in_array($key, $idGejala)) {
                    $bobot[$idPenyakit] += $value;
                }
            }
        }

        // Menghitung persentase bobot untuk setiap penyakit
        foreach ($bobot as $key => $value) {
            $jumlahGejala = count($aturan[$key]);
            $bobot[$key] = ($jumlahGejala > 0) ? round(($value / $jumlahGejala) * 100, 2) : 0;
        }

        // Melakukan pemetaan bobot ke nama penyakit
        $bobot = collect($bobot)->mapWithKeys(function ($item, $key) {
            $penyakit = Penyakit::find($key, ['id', 'name']);
            return [$penyakit->name => $item];
        });

        return response()->json($bobot);
    }

    public function getAturan()
    {
        $aturan = Rule::get(['penyakit_id', 'gejala_id'])->groupBy('penyakit_id')->map(function ($item) {
            return $item->pluck('gejala_id');
        });

        return response()->json($aturan);
    }
}
