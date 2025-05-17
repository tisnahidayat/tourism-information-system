@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center position-relative">
        <img src="{{ asset('img/bg_seni.jpg') }}" class="image-content-detail" alt="...">
        {{-- <h3 class="position-absolute text-danger">Detail Hotel</h3> --}}
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <span class="text-primary font-weight-bold" style="font-size: 17px;">{{ $senibudaya->kategori }}</span>
                <h3>{{ $senibudaya->nama }}</h3>
                <p class="indent">{{ $senibudaya->deskripsi }}
            </div>
            <div class="col-12 col-lg-6 col-md-6 wrapper-detail">
                <img src="{{ asset('storage/' . $senibudaya->gambar) }}" class="image-detail" alt="">
            </div>
        </div>
    </div>
@endsection
