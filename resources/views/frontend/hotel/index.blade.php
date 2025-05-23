@extends('layouts.main')

@section('content')
    {{-- Select2 Hotels --}}
    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/hotel.jpg') }}" class="image-content-detail" alt="...">
        <div class="position-absolute p-2 d-flex justify-content-center">
            <a href="/topkomentar" class="btn btn-primary p-2 font-weight-bolder px-4">Top Komentar</a>
        </div>
    </div>
    <div class="container-fluid mt-3">
        <form id="filterForm" method="POST" class="row g-3 justify-content-md-end">
            @csrf
            <div class="col-12 col-sm-4 col-md-3 col-lg-4">
                <div class="form-group">
                    <select id="hotel" class="form-control select2" name="hotel">
                        <option value="" selected>Semua Hotel</option>
                        @foreach ($dropdown as $hotel)
                            <option value="{{ $hotel->id }}"
                                {{ Session::get('selectedHotel') == $hotel->id ? 'selected' : '' }}>
                                {{ $hotel->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-auto col-lg-auto">
                <button type="submit" id="filterButton" class="btn btn-primary p-2 font-weight-bolder px-4">Cari</button>
            </div>
        </form>
    </div>


    <div class="container mx-auto mb-3">
        <div class="row">
            @if ($hotels->count() > 0)
                @foreach ($hotels as $hotel)
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card card-primary h-100 shadow">
                            <img src="{{ asset('storage/' . $hotel->gambar) }}" class="card-img-top" height="200"
                                alt="{{ $hotel->nama }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $hotel->nama }}</h5>
                                <div class="truncate-text mb-3">
                                    <p class="card-text">{{ $hotel->deskripsi }}</p>
                                </div>
                                <a href="/hotel/{{ $hotel->slug }}" class="btn btn-icon icon-left btn-info"><i
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
        <div class="row">
            <div class="col-12 col-sm-4 col-md-6 col-lg-6">
                <a href="" class="btn btn-primary p-2 font-weight-bolder px-4">Top Komentar</a>
            </div>
            <div class="col-12 col-sm-4 col-md-6 col-lg-6 d-flex justify-content-end">
                {{ $hotels->links() }}
            </div>
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
