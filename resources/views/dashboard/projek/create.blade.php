@extends('dashboard.layout')

@section('konten')
<div class="pb-3">
    <a href="{{ route('projek.index') }}" class="btn btn-secondary">
        &laquo; Kembali
    </a>
</div>

<form action="{{ route('projek.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- FOTO PROJEK --}}
    <div class="mb-3">
        <label class="form-label">Foto Projek</label>
        <input
            type="file"
            name="foto_projeks"
            class="form-control form-control-sm @error('foto_projeks') is-invalid @enderror">
        @error('foto_projeks')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- NAMA PROJEK --}}
    <div class="mb-3">
        <label class="form-label">Nama Projek</label>
        <input
            type="text"
            name="nama_projeks"
            class="form-control form-control-sm @error('nama_projeks') is-invalid @enderror"
            placeholder="Contoh: Website Company Profile"
            value="{{ old('nama_projeks') }}"
        >
        @error('nama_projeks')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-3">
        <label class="form-label">Deskripsi Projek</label>
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
