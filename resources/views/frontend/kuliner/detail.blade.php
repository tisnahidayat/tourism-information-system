@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center position-relative">
        <img src="{{ asset('img/bg_kuliner.jpg') }}" class="image-content-detail" alt="...">
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h3>{{ $kuliner->nama }}</h3>
                <p class="indent">{{ $kuliner->deskripsi }}</p>
                </p>
            </div>
            <div class="col-12 col-lg-6 col-md-6 wrapper-detail">
                <img src="{{ asset('storage/' . $kuliner->gambar) }}" class="image-detail" alt="">
            </div>
        </div>
    </div>
@endsection
