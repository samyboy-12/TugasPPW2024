@extends('layouts.admin')

@section('main-content')
<div class="container mt-5">
    <a href="{{ route('book.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
    <h4 class="mb-4">Daftar Buku</h4>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Foto Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_book as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->judul }}</td>
                <td>{{ $book->penulis }}</td>
                <td>{{ 'Rp. '.number_format($book->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($book->tgl_terbit)->format('d/m/Y') }}</td>
                <td>
                    @if($book->photo)
                        <img src="{{ asset('storage/'.$book->photo) }}" alt="Foto Buku" style="width: 100px; height: auto;">
                    @else
                        Tidak ada foto
                    @endif
                </td>
                <td>
                    <form action="{{ route('book.destroy', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    <form action="{{ route('book.edit', $book->id) }}" method="GET" style="display:inline;">
                        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                    </form>
                    <!-- Form for uploading photo -->
                    <form action="{{ route('book.upload', $book->id) }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                        @csrf
                        <input type="file" name="photo" class="form-control-file mb-1" required>
                        <button type="submit" class="btn btn-info btn-sm">Upload Foto</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <p><strong>Jumlah Buku:</strong> {{ $jumlah_book }}</p>
        <p><strong>Total Harga Semua Buku:</strong> {{ 'Rp. '.number_format($total_harga, 2, ',', '.') }}</p>
    </div>
</div>
@endsection
