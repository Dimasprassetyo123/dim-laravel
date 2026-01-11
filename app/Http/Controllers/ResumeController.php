<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResumeController extends Controller
{
    public function index()
    {
        // cukup satu orderBy (jangan ditimpa)
        $data = Resume::orderBy('periode', 'asc')->get();
        return view('dashboard.resum.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.resum.create');
    }

    public function store(Request $request)
    {
        Session::flash('periode', $request->periode);
        Session::flash('pekerjaan', $request->pekerjaan);

        $request->validate([
            'periode'   => 'required',
            'pekerjaan' => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'periode.required'   => 'Periode wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'image.required'     => 'Gambar wajib diisi',
        ]);

        $imageName = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('resum'), $imageName);
        }

        Resume::create([
            'image'     => $imageName,
            'periode'   => $request->periode,
            'pekerjaan' => $request->pekerjaan,
        ]);

        return redirect()->route('resum.index')
            ->with('success', 'Resume berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = Resume::where('id', $id)->first();
        return view('dashboard.resum.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'periode'   => 'required',
            'pekerjaan' => 'required',
            'image'     => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = Resume::where('id', $id)->first();
        $imageName = $data->image;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($data->image) {
                $oldImagePath = public_path('resum') . $data->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // Upload gambar baru
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('resum'), $imageName);
        }

        Resume::where('id', $id)->update([
            'image'     => $imageName,
            'periode'   => $request->periode,
            'pekerjaan' => $request->pekerjaan,
        ]);

        return redirect()->route('resum.index')
            ->with('success', 'Resume berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Resume::where('id', $id)->delete();
        return redirect()->route('resum.index')
            ->with('success', 'Resume berhasil dihapus');
    }
}
