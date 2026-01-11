@extends('dashboard.layout')

@section('konten')
    <p class="card-title text-warning fw-bold">Halaman Blog</p>

    <div class="pb-3">
        <a href="{{ route('blog.create') }}" class="btn btn-secondary">
            + Tambah Blog
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Foto Blog</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- FOTO BLOG --}}
                        <td>
                            @if ($item->foto_blog)
                                <img
                                    src="{{ asset('blog/' . $item->foto_blog) }}"
                                    width="60"
                                    height="60"
                                    class="img-thumbnail"
                                    alt="Foto Blog">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        {{-- JUDUL --}}
                        <td>{{ $item->judul }}</td>

                        {{-- KATEGORI --}}
                        <td>{{ $item->kategori }}</td>

                        {{-- DESKRIPSI --}}
                        <td>{{ Str::limit($item->deskripsi, 50) }}</td>

                        {{-- AKSI --}}
                        <td>
                            <a href="{{ route('blog.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form
                                action="{{ route('blog.destroy', $item->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin mau hapus blog ini?')"
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
                        <td colspan="6" class="text-center text-muted">
                            Data blog belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
