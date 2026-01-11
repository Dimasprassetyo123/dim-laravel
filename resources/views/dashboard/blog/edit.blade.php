@extends('dashboard.layout')

@section('konten')
<div class="pb-3">
    <a href="{{ route('blog.index') }}" class="btn btn-secondary">
        &laquo; Kembali
    </a>
</div>

<form action="{{ route('blog.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- FOTO BLOG --}}
    <div class="mb-3">
        <label class="form-label">Foto Blog</label>

        @if ($data->foto_blog)
            <div class="mb-2">
                <img
                    src="{{ asset('blog/' . $data->foto_blog) }}"
                    width="100"
                    height="100"
                    class="img-thumbnail"
                    alt="Foto Blog">
            </div>
        @endif

        <input
            type="file"
            name="foto_blog"
            class="form-control form-control-sm @error('foto_blog') is-invalid @enderror">

        @error('foto_blog')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- JUDUL BLOG --}}
    <div class="mb-3">
        <label class="form-label">Judul Blog</label>
        <input
            type="text"
            name="judul"
            class="form-control form-control-sm @error('judul') is-invalid @enderror"
            value="{{ old('judul', $data->judul) }}"
        >

        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- KATEGORI --}}
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <input
            type="text"
            name="kategori"
            class="form-control form-control-sm @error('kategori') is-invalid @enderror"
            value="{{ old('kategori', $data->kategori) }}"
        >

        @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-3">
        <label class="form-label">Deskripsi Blog</label>
        <textarea
            name="deskripsi"
            class="form-control summernote @error('deskripsi') is-invalid @enderror"
            rows="5"
        >{{ old('deskripsi', $data->deskripsi) }}</textarea>

        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan Perubahan
    </button>
</form>
@endsection
