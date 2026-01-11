@extends('dashboard.layout')

@section('konten')
<div class="pb-3">
    <a href="{{ route('halaman.index') }}" class="btn btn-secondary">
        << Kembali
    </a>
</div>

<form action="{{ route('halaman.update', $data->id) }}" method="POST">
    @csrf
    @method('put')
    {{-- Nama --}}
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input
            type="text"
            name="nama"
            class="form-control form-control-sm @error('nama') is-invalid @enderror"
            value="{{ $data->nama }}"
        >
    </div>

    {{-- Tanggal Lahir --}}
    <div class="mb-3">
        <label class="form-label">Tanggal Lahir</label>
        <input
            type="date"
            name="lahir"
            class="form-control form-control-sm @error('lahir') is-invalid @enderror"
            value="{{ $data->lahir }}"
        >
    </div>

    {{-- Alamat (SUMMERNOTE) --}}
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea
            name="alamat"
            class="form-control summernote @error('alamat') is-invalid @enderror"
            rows="5"
        >{{ $data->alamat }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>
@endsection
