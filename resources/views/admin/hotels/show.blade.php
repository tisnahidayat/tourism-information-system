@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item"><a href="/dashboard/hotel">Hotel</a></div>
            <div class="breadcrumb-item active">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-head">
                <h3>{{ $hotel->nama }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <p class="indent">{{ $hotel->deskripsi }}</p>
                        <p class="mt-3">Google Maps : <a href="{{ $hotel->lokasi }}">{{ $hotel->nama }}</a></p>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="{{ asset('storage/' . $hotel->gambar) }}" class="image-detail" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
