@extends('layouts.main')

@section('content')
    <img src="img/bg_kuliner.jpg" class="image-content" alt="...">
    <div class="container mx-auto my-4">
        <div class="row">
            @if ($kuliner->count() > 0)
                @foreach ($kuliner as $item)
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card card-primary h-100 shadow">
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" height="200"
                                alt="{{ $item->nama }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama }}</h5>
                                <p class="card-text truncate-text">{{ $item->deskripsi }}</p>
                                <a href="/kuliner/{{ $item->slug }}" class="btn btn-icon icon-left btn-info"><i
                                        class="fas fa-info-circle"></i> Selengkapnya ...</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 mx-auto text-center">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Mohon maaf,</strong> tujuan wisata anda belum tersedia saat ini😣.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $kuliner->links() }}
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
