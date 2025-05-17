@extends('layouts.main')

@section('content')
    <img src="img/bg_seni.jpg" class="image-content" alt="...">
    <div class="container mx-auto my-4">
        <div class="row">
            @if ($senibudaya->count() > 0)
                @foreach ($senibudaya as $item)
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4">
                        <div class="card card-primary h-100 shadow d-flex flex-row">
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-left" height="100%"
                                width="200px" style="object-fit: cover" alt="{{ $item->nama }}">
                            <div class="card-body my-auto">
                                <h5 class="card-title">{{ $item->nama }}</h5>
                                <h6 class="text-primary">{{ $item->kategori }}</h6>
                                <p class="card-text truncate-text">{{ $item->deskripsi }}</p>
                                <a href="/senibudaya/{{ $item->slug }}" class="btn btn-icon icon-left btn-info"><i
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
            {{ $senibudaya->links() }}
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
