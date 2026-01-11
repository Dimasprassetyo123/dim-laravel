@extends('dashboard.layout')

@section('konten')
<div class="pb-3">
    <a href="{{ route('blog.index') }}" class="btn btn-secondary">
        &laquo; Kembali
    </a>
</div>

<form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- FOTO BLOG --}}
    <div class="mb-3">
        <label class="form-label">Foto Blog</label>
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
            placeholder="Contoh: Tips Belajar Laravel"
            value="{{ old('judul') }}"
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
            placeholder="Contoh: Programming"
            value="{{ old('kategori') }}"
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
        >{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>
@endsection
