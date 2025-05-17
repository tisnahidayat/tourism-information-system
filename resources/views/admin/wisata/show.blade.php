@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item"><a href="/dashboard/wisata">Wisata</a></div>
            <div class="breadcrumb-item active">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-head">
                <h3>{{ $destinasi->nama }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="deskripsi-tab" data-toggle="tab" href="#deskripsi"
                                    role="tab" aria-controls="deskripsi" aria-selected="true">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab"
                                    aria-controls="map" aria-selected="false">Maps</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab"
                                    aria-controls="image" aria-selected="false">Gambar</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="deskripsi" role="tabpanel"
                                aria-labelledby="deskripsi-tab">
                                <p>Kategori :
                                    @switch($destinasi->kategori->nama)
                                        @case('Wisata Alam')
                                            <span class="text-success">
                                                {{ $destinasi->kategori->nama }}</span>
                                        @break

                                        @case('Wisata Sejarah')
                                            <span class="text-warning">{{ $destinasi->kategori->nama }}</span>
                                        @break

                                        @case('Wisata Bahari')
                                            <span class="text-info">{{ $destinasi->kategori->nama }}</span>
                                        @break

                                        @case('Wisata Religi')
                                            <span class="text-primary">{{ $destinasi->kategori->nama }}</span>
                                        @break

                                        @default
                                            <span class="text-danger">{{ $destinasi->kategori->nama }}</span>
                                    @endswitch
                                </p>
                                <p class="indent">{{ $destinasi->deskripsi }}</p>
                                <p>Tiket Masuk: Rp. {{ number_format($destinasi->harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
                                <iframe class="embed-responsive-item rounded" frameborder="0"
                                    style="border:0; width: 100%; height: 285px" src="{{ $destinasi->lokasi }}"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="col-md-12">
                                    @if ($destinasi->gambar)
                                        <img src="{{ asset('storage/' . $destinasi->gambar) }}"
                                            alt="{{ $destinasi->nama }}" class="img-fluid"
                                            style="object-fit: cover; width: 100%; height: 400px">
                                    @else
                                        <p>Gambar tidak tersedia</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
