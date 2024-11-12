@extends('layouts.admin')

@section('main-content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Gallery</div>
            <div class="card-body">
                <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $gallery->description }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="picture">Gambar</label>
                        <input type="file" class="form-control-file" id="picture" name="picture">
                        <small class="text-muted">Unggah gambar jika ingin mengganti.</small>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
