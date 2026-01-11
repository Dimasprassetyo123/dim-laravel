<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class halamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $data = halaman::orderBy('nama', 'asc')
                    ->orderBy('lahir', 'asc')
                    ->orderBy('alamat', 'asc')
                    ->get();

    return view('dashboard.halaman.index')->with('data', $data);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.halaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nama', $request->nama);
        Session::flash('lahir', $request->lahir);
        Session::flash('alamat', $request->alamat);

        $request->validate(
            [
                'nama' => 'required',
                'lahir' => 'required',
                'alamat' => 'required',
            ],[
                'nama.required' => 'Nama wajib diisi',
                'lahir.required' => 'Tanggal lahir wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
            ]
        );

        $data = [
            'nama' => $request->nama,
            'lahir' => $request->lahir,
            'alamat' => $request->alamat,
        ];
        halaman::create($data);

        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = halaman::where('id', $id)->first();
        return view('dashboard.halaman.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nama' => 'required',
                'lahir' => 'required',
                'alamat' => 'required',
            ],[
                'nama.required' => 'Nama wajib diisi',
                'lahir.required' => 'Tanggal lahir wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
            ]
        );

        $data = [
            'nama' => $request->nama,
            'lahir' => $request->lahir,
            'alamat' => $request->alamat,
        ];
        halaman::where('id', $id)->update ($data);

        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        halaman::where('id', $id)->delete();
        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil menghapus data');
    }
}
