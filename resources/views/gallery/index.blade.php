@extends('layouts.admin')

@section('main-content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Gallery</span>
                <a href="{{ route('gallery.create') }}" class="btn btn-primary">Tambah Galeri</a>
            </div>
            <div class="card-body">
                <div class="row">
                    @if (!empty($galleries))
                    @foreach ($galleries as $gallery)
                    <div class="col-sm-2">
                        <div>
                            <a class="example-image-link" href="{{ asset('storage/posts_image/' . $gallery['picture']) }}"
                                data-lightbox="roadtrip" data-title="{{ $gallery['description'] }}">
                                <img class="example-image img-fluid mb-2" src="{{ asset('storage/posts_image/' . $gallery['picture']) }}"
                                    alt="{{ $gallery['description'] }}" />
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h3>Tidak ada data.</h3>
                    @endif

                    <div class="d-flex">
                        {{ $galleries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('lightbox2-dev/src/js/lightbox.js') }}"></script>
@endsection