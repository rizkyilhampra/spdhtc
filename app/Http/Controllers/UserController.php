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
        //get id, name, reason, solution, image from penyakit models
        $penyakit = Penyakit::get(['id', 'name', 'reason', 'solution', 'image']);
        $collaborators = $this->getCollaboratorGithub();

        return view('user.user', compact('penyakit', 'collaborators'));
    }

    public function getCollaboratorGithub()
    {
        $collaborators = new GetCollaboratorGithubController();
        $collaborators = $collaborators->getCollaborators();
        return $collaborators;
    }

    public function historiDiagnosis(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Forbidden');
        } else if ($request->isMethod('delete')) {
            $diagnosis = Diagnosis::find($request->id);
            $diagnosis->delete();
            return response()->json([
                'message' => 'Berhasil menghapus data',
            ]);
        }

        $user = auth()->user();

        $start = $request->input('start', 0);
        $length = $request->input('length', 5);

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

        $historiDiagnosis = $query->offset($start)
            ->limit($length)
            ->get(['id', 'created_at', 'penyakit_id']);

        $data = $historiDiagnosis->map(function ($item) {
            $item->penyakit = Penyakit::find($item->penyakit_id, ['name']) ?? ['name' => 'Tidak Diketahui'];
            return $item;
        });

        $no = $start + 1;
        $data = $data->map(function ($item) use (&$no) {
            $item->no = $no++;
            return $item;
        });

        if ($request->has('order.0.column') && $request->has('order.0.dir')) {
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');
            if ($orderColumn == 0) {
                $data = $data->sortBy('no', SORT_REGULAR, $orderDirection == 'desc')->values();
            } else if ($orderColumn == 1) {
                $data = $data->sortBy('created_at', SORT_REGULAR, $orderDirection == 'desc')->values();
            } else if ($orderColumn == 2) {
                $data = $data->sortBy('penyakit.name', SORT_REGULAR, $orderDirection == 'desc')->values();
            }
        }

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ]);
    }

    public function historiDiagnosisDetail(Request $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Forbidden');
        }

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
