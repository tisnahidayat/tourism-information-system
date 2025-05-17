@extends('layouts.main')

@section('content')
    {{-- Select2 Hotels --}}
    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/hotel.jpg') }}" class="image-content-detail" alt="...">
        <div class="card position-absolute p-2 d-flex justify-content-center"
            style="background-color: rgba(255, 255, 255, 0.644);">
            <span class="text-primary font-weight-bold" style="font-size: 25px;">Top Komentar</span>
        </div>
    </div>
    <div class="container my-4">
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-12 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="ui-card rounded card-primary h-100 shadow">
                        <div class="img-wrapper">
                            <a href="/hotel/{{ $hotel->slug }}">
                                <img src="{{ asset('storage/' . $hotel->gambar) }}" class="card-img-top"
                                    style="object-fit: cover" height="200" alt="{{ $hotel->nama }}">
                                <div class="card-overlay">
                                    <h5 class="card-title text-dark">{{ $hotel->nama }}</h5>
                                    <h5 class="text-dark"><i class="fa-solid fa-comment"></i> {{ $hotel->total_comments }}
                                    </h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
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
