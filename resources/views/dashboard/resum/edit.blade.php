@extends('dashboard.layout')

@section('konten')
<div class="pb-3">
    <a href="{{ route('resum.index') }}" class="btn btn-secondary">
        &laquo; Kembali
    </a>
</div>

<form action="{{ route('resum.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    {{-- IMAGE --}}
    <div class="mb-3">
        <label class="form-label">Image</label>
        @if ($data->image)
            <div class="mb-2">
                <img src="{{ asset('resum/' . $data->image) }}"
                     width="100"
                     height="100"
                     class="img-thumbnail">
            </div>
        @endif
        <input
            type="file"
            name="image"
            class="form-control form-control-sm @error('image') is-invalid @enderror"
        >
    </div>

    {{-- PERIODE --}}
    <div class="mb-3">
        <label class="form-label">Periode</label>
        <input
            type="text"
            name="periode"
            class="form-control form-control-sm @error('periode') is-invalid @enderror"
            placeholder="Contoh: 2022 - 2024"
            value="{{ $data->periode }}"
        >
    </div>

    {{-- PEKERJAAN --}}
    <div class="mb-3">
        <label class="form-label">Pekerjaan</label>
        <textarea
            name="pekerjaan"
            class="form-control summernote @error('pekerjaan') is-invalid @enderror"
            rows="5"
        >{{ $data->pekerjaan }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>
@endsection
