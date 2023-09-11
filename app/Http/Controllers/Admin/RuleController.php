<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = $this->getRule();
        return view('admin.rule.rule', compact('rules'));
    }

    private function getRule()
    {
        $rules = Rule::with(['penyakit' => function ($query) {
            $query->select('id', 'name');
        }, 'gejala' => function ($query) {
            $query->select('id', 'name');
        }])->get(['id', 'penyakit_id', 'gejala_id', 'next_first_gejala_id', 'updated_at'])->map(function ($rule) {
            $rule['penyakit'] = $rule['penyakit']->toArray();
            $rule['gejala'] = $rule['gejala']->toArray();
            return [
                'id' => $rule['id'],
                'updated_at' => $rule['updated_at'],
                'penyakit' => $rule['penyakit'],
                'gejala' => $rule['gejala'],
                'nextGejala' => [
                    'id' => $rule['next_first_gejala_id'],
                    'name' => $rule['next_first_gejala_id'] ? Gejala::find($rule['next_first_gejala_id'])->name : ''
                ]
            ];
        })->values()->toArray();

        return $rules;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penyakit = Penyakit::select('id', 'name')->orderByDesc('updated_at')->get();
        $gejala = Gejala::select('id', 'name')->orderByDesc('updated_at')->get();

        $data = [
            'penyakit' => $penyakit,
            'gejala' => $gejala,
            'gejalaGroupBy' => $this->getGejalaGroupBy(),
        ];

        return view('admin.rule.tambah', $data);
    }

    /**
     * getGejalaGroupBy
     *
     * @return void
     */
    private static function getGejalaGroupBy()
    {
        $gejalaGroupBy = Rule::select('id', 'penyakit_id', 'gejala_id')->with(['gejala' => function ($query) {
            $query->select('id', 'name');
        }])->get()->groupBy('penyakit_id')->map(function ($item) {
            return $item->first()->gejala;
        });
        return $gejalaGroupBy;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'penyakit' => 'required',
            'gejala' => 'required',
            'nextGejala'  => 'required'
        ]);

        $gejala = $request->input('gejala');
        foreach ($gejala as $key => $value) {
            $gejala[$key] = (int) $value;
        }

        foreach ($gejala as $key => $value) {
            Rule::create([
                'penyakit_id' => (int) $request->input('penyakit'),
                'gejala_id' => $value,
                'next_first_gejala_id' => (int) $request->input('nextGejala'),
            ]);
        }

        return redirect()->route('admin.rule')->with('success', 'Rule berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rule = Rule::with(['penyakit' => function ($query) {
            $query->select('id', 'name');
        }, 'gejala' => function ($query) {
            $query->select('id', 'name');
        }])->findOrFail($id, ['id', 'penyakit_id', 'gejala_id', 'next_first_gejala_id', 'updated_at'])->toArray();

        $penyakit = Penyakit::select('id', 'name')->orderByDesc('updated_at')->get();
        $gejala = Gejala::select('id', 'name')->orderByDesc('updated_at')->get();

        $data = [
            'penyakit' => $penyakit,
            'gejala' => $gejala,
            'rule' => $rule,
            'gejalaGroupBy' => $this->getGejalaGroupBy(),
        ];

        return view('admin.rule.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule = Rule::findOrFail($id);
        $rule->penyakit_id = $request->input('penyakit');
        $rule->gejala_id = $request->input('gejala');
        $rule->next_first_gejala_id = $request->input('nextGejala');
        $rule->save();

        return redirect()->route('admin.rule')->with('success', 'Rule berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->delete();

        return redirect()->route('admin.rule')->with('success', 'Rule berhasil dihapus');
    }
}
