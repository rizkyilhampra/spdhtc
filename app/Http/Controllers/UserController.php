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
}
