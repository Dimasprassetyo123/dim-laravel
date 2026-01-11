@extends('dashboard.layout')

@section('konten')
    <p class="card-title text-warning fw-bold">Halaman About</p>

    <div class="pb-3">
        <a href="{{ route('halaman.create') }}" class="btn btn-secondary">+ Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama</th>
                    <th>Lahir</th>
                    <th>Alamat</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->lahir }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <a href="{{ route('halaman.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form onsubmit="return confirm('Yakin mau hapus ?')" action="{{ route('halaman.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
