@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center position-relative">
        <img src="{{ asset('img/bg_blog.jpg') }}" class="image-content-detail" alt="...">
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <span class="text-primary font-weight-bold" style="font-size: 17px;">{{ $post->kategori }}</span>
                <h3>{{ $post->judul }}</h3>
                <p class="indent">{{ $post->deskripsi }}</p>
                </p>
            </div>
            <div class="col-12 col-lg-6 col-md-6 wrapper-detail">
                <img src="{{ asset('storage/' . $post->gambar) }}" class="image-detail" alt="">
            </div>
        </div>
    </div>
@endsection
