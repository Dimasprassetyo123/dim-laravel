<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::orderBy('created_at', 'desc')->get();
        return view('dashboard.blog.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.blog.create');
    }

    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('kategori', $request->kategori);
        Session::flash('deskripsi', $request->deskripsi);

        $request->validate([
            'judul'      => 'required',
            'kategori'   => 'required',
            'deskripsi'  => 'required',
            'foto_blog'  => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'judul.required'     => 'Judul wajib diisi',
            'kategori.required'  => 'Kategori wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'foto_blog.required' => 'Foto blog wajib diisi',
        ]);

        $fotoName = null;
        if ($request->hasFile('foto_blog')) {
            $file = $request->file('foto_blog');
            $fotoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('blog'), $fotoName);
        }

        Blog::create([
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto_blog' => $fotoName,
        ]);

        return redirect()->route('blog.index')
            ->with('success', 'Blog berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $data = Blog::findOrFail($id);
        return view('dashboard.blog.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'     => 'required',
            'kategori'  => 'required',
            'deskripsi' => 'required',
            'foto_blog' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = Blog::findOrFail($id);
        $fotoName = $data->foto_blog;

        if ($request->hasFile('foto_blog')) {
            // hapus foto lama
            if ($data->foto_blog) {
                $oldPath = public_path('blog/' . $data->foto_blog);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // upload foto baru
            $file = $request->file('foto_blog');
            $fotoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('blog'), $fotoName);
        }

        $data->update([
            'judul'     => $request->judul,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto_blog' => $fotoName,
        ]);

        return redirect()->route('blog.index')
            ->with('success', 'Blog berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $data = Blog::findOrFail($id);

        if ($data->foto_blog) {
            $path = public_path('blog/' . $data->foto_blog);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $data->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Blog berhasil dihapus');
    }
}
