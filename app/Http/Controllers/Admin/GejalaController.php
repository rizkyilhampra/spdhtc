<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

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

        $data = [
            'gejala' => $gejala,
            'loginDuration' =>  $this->LoginDuration()
        ];
        return view('admin.gejala.gejala', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loginDuration = $this->LoginDuration();
        return view('admin.gejala.tambah', compact('loginDuration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'name' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            //upload image
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/gejala', $new_name);

            $form_data = array(
                'name' => $request->name,
                'image' => $new_name
            );

            Gejala::create($form_data);
            //isi dengan blok kode dari function
            return redirect()->route('admin.gejala')->with('success', 'Berhasil');
        } catch (\Exception $e) {
            return redirect()->route('admin.gejala')->with('error', $e);
        }

        //return redirect(route('admin.gejala'))->with('success', 'Data berhasil ditambahkan!');
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
        $gejala = gejala::findOrFail($id);
        $loginDuration = $this->LoginDuration();
        return view('admin.gejala.edit', compact('gejala', 'loginDuration'));
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
        try {
            $gejala = Gejala::findOrFail($id);
            $this->validate($request, [
                'name' => 'required',
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
                'name' => $request->name,
                'image' => $new_name ?? $gejala->image
            );

            $gejala->update($form_data);

            return redirect()->route('admin.gejala')->with('success', 'Berhasil');
        } catch (\Exception $e) {
            return redirect()->route('admin.gejala')->with('error', $e);
        }


        //return redirect(route('admin.gejala'))->with('success', 'Data berhasil diubah!');
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
        $old_image = $gejala->image;
        $image_path = "public/gejala/" . $old_image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $gejala->delete();
        return redirect(route('admin.gejala'))->with('success', 'Data berhasil dihapus!');
    }
}
