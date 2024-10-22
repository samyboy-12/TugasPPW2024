@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4>{{ isset($book) ? 'Edit Buku' : 'Tambah Buku' }}</h4>
    <form method="post" action="{{ isset($book) ? route('book.update', $book->id) : route('book.store') }}">
        @csrf
        @if(isset($book))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="judul">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $book->judul ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $book->penulis ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $book->harga ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $book->tgl_terbit ?? '' }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($book) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('book.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
