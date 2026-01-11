@extends('dashboard.layout')

@section('konten')
    <p class="card-title text-warning fw-bold">Halaman Projek</p>

    <div class="pb-3">
        <a href="{{ route('projek.create') }}" class="btn btn-secondary">
            + Tambah Projek
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Foto Projek</th>
                    <th>Nama Projek</th>
                    <th>Deskripsi</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- FOTO PROJEK --}}
                        <td>
                            @if ($item->foto_projeks)
                                <img
                                    src="{{ asset('projek/' . $item->foto_projeks) }}"
                                    width="60"
                                    height="60"
                                    class="img-thumbnail"
                                    alt="Foto Projek">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        {{-- NAMA PROJEK --}}
                        <td>{{ $item->nama_projeks }}</td>

                        {{-- DESKRIPSI --}}
                        <td>{{ Str::limit($item->deskripsi, 50) }}</td>

                        {{-- AKSI --}}
                        <td>
                            <a href="{{ route('projek.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form
                                action="{{ route('projek.destroy', $item->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin mau hapus projek ini?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Data projek belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
