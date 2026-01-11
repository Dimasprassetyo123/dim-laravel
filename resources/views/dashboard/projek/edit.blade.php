@extends('dashboard.layout')

@section('konten')
<div class="pb-3">
    <a href="{{ route('projek.index') }}" class="btn btn-secondary">
        &laquo; Kembali
    </a>
</div>

<form action="{{ route('projek.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- FOTO PROJEK --}}
    <div class="mb-3">
        <label class="form-label">Foto Projek</label>

        @if ($data->foto_projeks)
            <div class="mb-2">
                <img
                    src="{{ asset('projek/' . $data->foto_projeks) }}"
                    width="100"
                    height="100"
                    class="img-thumbnail"
                    alt="Foto Projek">
            </div>
        @endif

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
            value="{{ old('nama_projeks', $data->nama_projeks) }}"
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
