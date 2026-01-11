<?php

namespace App\Http\Controllers;

use App\Models\projek; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjekController extends Controller
{
    public function index()
    {
        $data = projek::orderBy('created_at', 'desc')->get();
        return view('dashboard.projek.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.projek.create');
    }

    public function store(Request $request)
    {
        Session::flash('nama_projeks', $request->nama_projeks);
        Session::flash('deskripsi', $request->deskripsi);

        $request->validate([
            'nama_projeks' => 'required',
            'deskripsi'    => 'required',
            'foto_projeks' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'nama_projeks.required' => 'Nama projek wajib diisi',
            'deskripsi.required'    => 'Deskripsi wajib diisi',
            'foto_projeks.required' => 'Foto projek wajib diisi',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto_projeks')) {
            $file = $request->file('foto_projeks');
            $fotoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('projek'), $fotoName);
        }

        projek::create([
            'foto_projeks' => $fotoName,
            'nama_projeks' => $request->nama_projeks,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->route('projek.index')
            ->with('success', 'Projek berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $data = projek::findOrFail($id);
        return view('dashboard.projek.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_projeks' => 'required',
            'deskripsi'    => 'required',
            'foto_projeks' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = projek::findOrFail($id);
        $fotoName = $data->foto_projeks;

        if ($request->hasFile('foto_projeks')) {
            // hapus foto lama
            if ($data->foto_projeks) {
                $oldPath = public_path('projek/' . $data->foto_projeks);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // upload foto baru
            $file = $request->file('foto_projeks');
            $fotoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('projek'), $fotoName);
        }

        $data->update([
            'foto_projeks' => $fotoName,
            'nama_projeks' => $request->nama_projeks,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->route('projek.index')
            ->with('success', 'Projek berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $data = projek::findOrFail($id);

        if ($data->foto_projeks) {
            $path = public_path('projek/' . $data->foto_projeks);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $data->delete();

        return redirect()->route('projek.index')
            ->with('success', 'Projek berhasil dihapus');
    }
}
