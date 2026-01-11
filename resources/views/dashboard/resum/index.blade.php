@extends('dashboard.layout')

@section('konten')
    <p class="card-title text-warning fw-bold">Halaman Resume</p>

    <div class="pb-3">
        <a href="{{ route('resum.create') }}" class="btn btn-secondary">+ Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Image</th>
                    <th>Periode</th>
                    <th>Pekerjaan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- IMAGE --}}
                        <td>
                            @if ($item->image)
                                <img src="{{ asset('resum/' . $item->image) }}"
                                     width="60"
                                     height="60"
                                     class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- PERIODE --}}
                        <td>{{ $item->periode }}</td>

                        {{-- PEKERJAAN --}}
                        <td>{{ $item->pekerjaan }}</td>

                        {{-- AKSI --}}
                        <td>
                            <a href="{{ route('resum.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form
                                onsubmit="return confirm('Yakin mau hapus ?')"
                                action="{{ route('resum.destroy', $item->id) }}"
                                method="POST"
                                class="d-inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
