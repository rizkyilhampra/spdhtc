<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Gejala;
use App\Models\Penyakit;
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

            $no = ($orderDirection == 'asc') ? $start + 1 : $totalData - $start;
        }

        $historiDiagnosis = $query
            ->offset($start)
            ->limit($length)
            ->get(['id', 'created_at', 'penyakit_id']);

        $data = $historiDiagnosis->map(function ($item) use (&$no, $orderDirection) {
            $penyakit = Penyakit::find($item->penyakit_id, ['name']);
            $item->penyakit = $penyakit ? $penyakit->name : 'Tidak Diketahui';
            $item->no = ($orderDirection == 'asc') ? $no++ : $no--;
            return $item;
        });

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ]);
    }

    public function historiDiagnosisDetail(Request $request)
    {
        $diagnosis = Diagnosis::find($request->id, ['answer_log']);
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
                'no' => $request->no,
                'id' => $item->id,
                'name' => $item->name,
                'answer' => $item->answer,
            ];
        });

        return response()->json([
            'answerLog' => $answerLog,
        ]);
    }
}
