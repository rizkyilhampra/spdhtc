<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gejala = Gejala::get(['id', 'name', 'image', 'updated_at']);
        return view('admin.gejala.gejala', compact('gejala'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gejala.tambah');
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
            'gejala' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //upload image
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/gejala', $new_name);

        $form_data = array(
            'name' => $request->gejala,
            'image' => $new_name
        );

        Gejala::create($form_data);

        return redirect(route('admin.gejala'))->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gejala = gejala::findOrFail($id);
        return view('admin.gejala.edit', compact('gejala'));
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
        $gejala = Gejala::findOrFail($id);

        $this->validate($request, [
            'gejala' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $old_image = $gejala->image;
            $image_path = "public/gejala/" . $old_image;

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/gejala', $new_name);
        }

        $form_data = array(
            'name' => $request->gejala,
            'image' => $new_name ?? $gejala->image
        );

        $gejala->update($form_data);

        return redirect(route('admin.gejala'))->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gejala = Gejala::findOrFail($id);

        try {
            if ($gejala->delete()) {
                Storage::delete('public/gejala/' . $gejala->image);
            }
        } catch (QueryException $q) {
            if ($q->getCode() == 23000) {
                return redirect()->route('admin.gejala')->with('error', 'Data tidak dapat dihapus karena sedang digunakan!');
            }
        }

        return redirect(route('admin.gejala'))->with('success', 'Data berhasil dihapus!');
    }
}
