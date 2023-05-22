<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

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
            'loginDuration' =>  $this->LoginDuration()
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
        $loginDuration = $this->LoginDuration();
        return view('admin.penyakit.tambah', compact('loginDuration'));
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
            'name' => 'required',
            'reason' => 'required',
            'solution' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //upload image
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/penyakit', $new_name);

        $form_data = array(
            'name' => $request->name,
            'reason' => $request->reason,
            'solution' => $request->solution,
            'image' => $new_name
        );

        Penyakit::create($form_data);

        return redirect(route('admin.penyakit'))->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $loginDuration = $this->LoginDuration();
        return view('admin.penyakit.edit', compact('penyakit', 'loginDuration'));
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
            'name' => 'required',
            'reason' => 'required',
            'solution' => 'required',
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
            'name' => $request->name,
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
        try {
            $penyakit = Penyakit::findOrFail($id);
            $old_image = $penyakit->image;
            $image_path = "public/penyakit/" . $old_image;
            if (file_exists($image_path)) {
                try {
                    unlink($image_path);
                } catch (\Exception $th) {
                    return redirect(route('admin.penyakit'))->with('error', 'Foto gagal dihapus!');
                }
            }
            $penyakit->delete();
            return redirect(route('admin.penyakit'))->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $th) {
            return redirect(route('admin.penyakit'))->with('error', 'Data gagal dihapus!');
        }
    }
}
