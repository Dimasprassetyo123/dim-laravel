@extends('dashboard.layout')

@section('konten')
<div class="pb-3">
    <a href="{{ route('halaman.index') }}" class="btn btn-secondary">
        << Kembali
    </a>
</div>

<form action="{{ route('halaman.store') }}" method="POST">
    @csrf

    {{-- Nama --}}
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input
            type="text"
            name="nama"
            class="form-control form-control-sm @error('nama') is-invalid @enderror"
            value="{{ Session::get('nama') }}"
        >
    </div>

    {{-- Tanggal Lahir --}}
    <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input
            type="date"
            name="lahir"
            class="form-control form-control-sm @error('lahir') is-invalid @enderror"
            value="{{ Session::get('lahir') }}"
        >
    </div>

    {{-- Alamat (SUMMERNOTE) --}}
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea
            name="alamat"
            class="form-control summernote @error('alamat') is-invalid @enderror"
            rows="5"
        >{{ Session::get('alamat') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>
@endsection
