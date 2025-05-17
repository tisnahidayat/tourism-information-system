@extends('layouts.main')

@section('content')
    {{-- Carousel --}}
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($carousels as $key => $carousel)
                <li data-target="#carouselExampleCaptions" data-slide-to="{{ $key }}"
                    {{ $key == 0 ? 'class=active' : '' }}></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($carousels as $key => $carousel)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset('img/' . $carousel['gambar']) }}" class="d-block w-100 vh-100"
                        style="object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $carousel['judul'] }}</h5>
                        <div class="card-body">
                            <p style="font-size: 14px">{{ $carousel['deskripsi'] }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" data-target="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" data-target="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    {{-- Profile --}}
    <div class="container-fluid py-4" style="background-color: rgb(245, 242, 245)" data-aos="fade-up"
        data-aos-anchor-placement="top-bottom">
        <h2 class="text-center font-weight-semibold">Video Kota Karawang</h2>
        <div class="d-flex justify-content-center mb-4">
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 d-flex align-items-center">
                <div class="mb-3">
                    <h2>Visit Karawang!</h2>
                    <p>Kota Karawang dikenal sebutan kota pangkal perjuangan. Dari tempat inilah naskah proklamasi
                        kemerdekaan republik indonesia dibuat. Bukan hanya itu! Kota Karawang juga memiliki keindahan
                        panorama dari sudut yang lainnya. Penasaran bukan? Tunggu apalagi. Hayuk urang ka Karawang!</p>
                    <a href="" class="btn btn-icon icon-left btn-info"><i class="fas fa-info-circle"></i>
                        Selengkapnya ...</a>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <iframe width="100%" height="315" class="rounded"
                    src="https://www.youtube.com/embed/sXAxJEUHH9g?si=6JR35lgYkFt74CCB&rel=0" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    {{-- Top 5 Wisata --}}
    <div class="container mx-auto pt-4 align-items-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <h2 class="text-center font-weight-semibold">Top 5 Wisata Populer</h2>
        <div class="d-flex justify-content-center mb-4">
        </div>
        <div class="row justify-content-center">
            @foreach ($wisata as $item)
                <div class="col-12 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="ui-card rounded card-primary h-100 shadow">
                        <div class="img-wrapper">
                            <a href="/wisata/{{ $item->slug }}">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                    style="object-fit: cover" height="200" alt="{{ $item->nama }}">
                                <div class="card-overlay">
                                    <h5 class="card-title">{{ $item->nama }}</h5>
                                    <h5>{{ number_format($item->avg_rating, 1) }} ⭐</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Kategori Wisata --}}
    <div class="container mx-auto pt-4 align-items-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <h2 class="text-center font-weight-semibold">Kategori Wisata</h2>
        <div class="d-flex justify-content-center mb-4">
        </div>
        <div class="row justify-content-center">
            @foreach ($kategori as $item)
                <div class="col-lg-3 mb-4">
                    <div class="ui-card rounded">
                        <a href="/wisata?kategori={{ $item->slug }}">
                            <div class="img-wrapper">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top">
                                <div class="card-overlay">
                                    <h3>{{ $item->nama }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Navigasi Wisata --}}
    <div class="container mx-auto pt-4 align-items-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <h2 class="text-center font-weight-semibold">Navigasi</h2>
        <div class="d-flex justify-content-center mb-3">
        </div>
        <p class="text-center mx-auto w-75 mb-4" style="font-size: 20px;">Berwisata di Kota Karawang tidak cukup jika
            hanya
            mengunjungi satu kawasan. Jelajahi berbagai tempat favorit mulai dari kawasan wisata kuliner, seni budaya,
            sejarah sampai hiburan dan rekreasi.</p>
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="ui-card rounded">
                    <a href="/wisata">
                        <div class="img-wrapper">
                            <img src="img/bahari.jpg" class="card-img-top">
                            <div class="card-overlay">
                                <h3>Destinasi Wisata</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="ui-card rounded">
                    <a href="/senibudaya">
                        <div class="img-wrapper">
                            <img src="img/gokar.jpg" class="card-img-top">
                            <div class="card-overlay">
                                <h3>Seni dan Budaya</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="ui-card rounded">
                    <a href="/kuliner">
                        <div class="img-wrapper">
                            <img src="img/kuliner.jpg" class="card-img-top">
                            <div class="card-overlay">
                                <h3>Kuliner</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="ui-card rounded">
                    <a href="/blog">
                        <div class="img-wrapper">
                            <img src="img/blog.jpg" class="card-img-top">
                            <div class="card-overlay">
                                <h3>Blog Wisata</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Kritik dan Saran --}}
    <div class="container mx-auto pt-4 align-items-center" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <h2 class="text-center font-weight-semibold">Kritik dan Saran</h2>
        <div class="d-flex justify-content-center mb-3">
        </div>
        <div id="testimonialCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
                @foreach ($feedbacks as $index => $feedback)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card mt-3">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $feedback->user->username }}</h5>
                                        <p class="card-text">{{ $feedback->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('script')
        <script>
            AOS.init({
                once: false,
                duration: 1000
            });
        </script>
    @endpush
