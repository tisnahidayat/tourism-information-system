@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/wisata.jpg') }}" class="image-content-detail" alt="...">
        <div class="card position-absolute p-2 d-flex justify-content-center"
            style="background-color: rgba(255, 255, 255, 0.644);">
            <span class="text-primary font-weight-bold" style="font-size: 25px;">Detail Wisata</span>
        </div>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h3 class="position-absolute">{{ $wisata->nama }}</h3>
                <span class="d-flex justify-content-end position-relative mb-2" style="margin: 7px 0 0 0">
                    ⭐{{ number_format($averageRating, 1) }} ({{ $totalRatings }} Ratings)
                </span>
                @if (session()->has('success_' . $wisata->id))
                    <div class="alert alert-success" role="alert">
                        {{ session('success_' . $wisata->id) }}
                    </div>
                @endif
                @if (session()->has('error_' . $wisata->id))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error_' . $wisata->id) }}
                    </div>
                @endif
                <p><b>Kategori : </b> <a
                        href="/wisata?kategori={{ $wisata->kategori->slug }}">{{ $wisata->kategori->nama }}</a></p>
                <p class="indent">{{ $wisata->deskripsi }}</p>
                <p>Tiket Masuk : Rp. {{ number_format($wisata->harga, 0, ',', '.') }}</p>
                <h5>Kasih ulasan wisata ini! 😉</h5>
                @guest
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                        Anda harus <a href="{{ route('login') }}"><strong>login</strong></a> terlebih dahulu untuk memberikan
                        ulasan.
                    </div>
                @endguest
                <form action="{{ url('/review') }}" method="POST" id="review">
                    @csrf
                    <input type="hidden" name="id_wisata" value="{{ $wisata->id }}">
                    <div class="rating-css mb-2">
                        <div class="star-icon">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" value="{{ $i }}" name="rating"
                                    id="rating{{ $i }}"
                                    {{ old('rating_' . $wisata->id, session('rating_' . $wisata->id, $existingReview->rating ?? 1)) == $i ? 'checked' : '' }}>
                                <label for="rating{{ $i }}" class="fa fa-star"></label>
                            @endfor
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Tinggalkan komentarmu disini!" id="floatingTextarea2" name="review"
                            style="height: 150px"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Kirim</button>
                </form>
            </div>
            <div class="col-12 col-lg-6 col-md-6 wrapper-detail">
                <img src="{{ asset('storage/' . $wisata->gambar) }}" class="image-content-detail mb-2"
                    alt="{{ $wisata->nama }}">
                <iframe class="embed-responsive-item rounded" frameborder="0" style="border:0; width: 100%; height: 285px"
                    src="{{ $wisata->lokasi }}" allowfullscreen></iframe>
                <div class="my-4">
                    <h4>Ulasan Pengguna</h4>
                    <div class="card my-2">
                        @forelse ($reviews as $review)
                            <div class="card-body border">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                                <p class="text-muted">
                                    @if ($review->updated_at != $review->created_at)
                                        Diperbarui: {{ $review->updated_at->format('d-m-Y') }}
                                    @else
                                        Diposting: {{ $review->created_at->format('d-m-Y') }}
                                    @endif
                                </p>
                                <span class="card-text">{{ $review->review }}</span><br>
                                <span class="card-subtitle mb-1 text-muted">By. {{ $review->user->username }}</span>
                                @if (Auth::check() && (Auth::user()->role === 'admin' || $review->user->id === Auth::id()))
                                    <form action="{{ route('review.destroy', ['id' => $review->id]) }}" method="POST"
                                        class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete(event)">Hapus Ulasan</button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <div class="card-body border">
                                <p class="m-auto text-center font-weight-bold text-danger">Belum ada ulasan untuk wisata
                                    ini. 🫡</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target.closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        document.getElementById('review').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            try {
                const response = await fetch(this.action, {
                    method: this.method,
                    body: formData
                });
                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message);
                }
                const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                if (isLoggedIn) {
                    Swal.fire({
                        title: 'Terima kasih! 😉',
                        text: 'Ulasan anda sangat berharga bagi kami!.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        this.reset();
                    });
                } else {
                    Swal.fire({
                        title: 'Uppsss! 🫣',
                        text: 'Anda harus login terlebih dahulu untuk memberikan ulasan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Tutup',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('login') }}';
                        }
                    });
                }

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Uppsss! 🫣',
                    text: error.message,
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            }
        });
    </script>
@endsection
