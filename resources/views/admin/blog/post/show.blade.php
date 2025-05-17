@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item"><a href="/dashboard/posting">Post</a></div>
            <div class="breadcrumb-item active">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-head">
                <h3>{{ $post->judul }}</h3>
            </div>
            <span class="mx-4">By. {{ $post->user->username }}
                {{ $post->created_at->format('Y-m-d') }}</span>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('storage/' . $post->gambar) }}" class="card-img img-fluid mb-2"
                            style="height: 300px; object-fit:cover;">
                        <article class="mt-2" style="font-size: 16px">
                            {!! $post->deskripsi !!} <br>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
