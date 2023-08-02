<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'penyakit' => Penyakit::get(['id', 'name', 'reason', 'solution', 'image', 'updated_at']),
        ];

        return view('admin.penyakit.penyakit', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.penyakit.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'penyakit' => 'required|string',
            'reason' => 'required|string',
            'solution' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //upload image
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/penyakit', $new_name);

        $form_data = array(
            'name' => $request->penyakit,
            'reason' => $request->reason,
            'solution' => $request->solution,
            'image' => $new_name
        );

        Penyakit::create($form_data);

        return redirect(route('admin.penyakit'))->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        return view('admin.penyakit.edit', compact('penyakit'));
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
        $penyakit = Penyakit::findOrFail($id);

        $this->validate($request, [
            'penyakit' => 'required|string',
            'reason' => 'required|string',
            'solution' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $old_image = $penyakit->image;
            $image_path = "public/penyakit/" . $old_image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/penyakit', $new_name);
        }

        $form_data = array(
            'name' => $request->penyakit,
            'reason' => $request->reason,
            'solution' => $request->solution,
            'image' => $new_name ?? $penyakit->image,
        );

        $penyakit->update($form_data);

        return redirect(route('admin.penyakit'))->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyakit = Penyakit::findOrFail($id);

        try {
            if ($penyakit->delete()) {
                Storage::delete('public/penyakit/' . $penyakit->image);
            }
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('admin.penyakit')->with('error', 'Data tidak dapat dihapus karena sedang digunakan!');
            }
        }

        return redirect(route('admin.penyakit'))->with('success', 'Data berhasil dihapus!');
    }
}
