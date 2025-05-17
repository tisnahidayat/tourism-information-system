@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/hotel.jpg') }}" class="image-content-detail" alt="...">
        <div class="card position-absolute p-2 d-flex justify-content-center"
            style="background-color: rgba(255, 255, 255, 0.644);">
            <span class="text-primary font-weight-bold" style="font-size: 25px;">Detail Hotel</span>
        </div>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h3 class="position-absolute">{{ $hotel->nama }}</h3>
                <span class="d-flex justify-content-end position-relative" style="margin: 6px 0px 0 0; font-size: 17px">
                    Rating : ⭐{{ $hotel->rating }}
                </span>
                <p>Lokasi : <a href="{{ $hotel->lokasi }}" target="_blank">{{ $hotel->nama }}</a></p>
                @if (session()->has('success_' . $hotel->id))
                    <div class="alert alert-success" role="alert">
                        {{ session('success_' . $hotel->id) }}
                    </div>
                @endif
                @if (session()->has('error_' . $hotel->id))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error_' . $hotel->id) }}
                    </div>
                @endif
                <p class="indent">{{ $hotel->deskripsi }}</p>
                <h5>Kasih komentar hotel ini! 😉</h5>
                @guest
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                        Anda harus <a href="{{ route('login') }}"><strong>login</strong></a> terlebih dahulu untuk memberikan
                        komentar.
                    </div>
                @endguest
                <form action="{{ url('/komentar') }}" method="POST" id="komentar">
                    @csrf
                    <input type="hidden" name="id_hotel" value="{{ $hotel->id }}">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Tinggalkan komentarmu disini!" id="floatingTextarea2" name="komentar"
                            style="height: 150px"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                </form>
            </div>
            <div class="col-12 col-lg-6 col-md-6 wrapper-detail">
                <img src="{{ asset('storage/' . $hotel->gambar) }}" class="image-detail" alt="">
                <div class="my-4">
                    <h4>Komentar Pengguna</h4>
                    <div class="card my-2">
                        @forelse ($komentar as $item)
                            <div class="card-body border">
                                <p class="text-muted">
                                    @if ($item->updated_at != $item->created_at)
                                        Diperbarui: {{ $item->updated_at->format('d-m-Y') }}
                                    @else
                                        Diposting: {{ $item->created_at->format('d-m-Y') }}
                                    @endif
                                </p>
                                <span class="card-text">{{ $item->komentar }}</span><br>
                                <span class="card-subtitle mb-1 text-muted">By. {{ $item->user->username }}</span>
                                @if (Auth::check() && (Auth::user()->role === 'admin' || $item->user->id === Auth::id()))
                                    <form action="{{ route('comment.destroy', ['id' => $item->id]) }}" method="POST"
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

        document.getElementById('komentar').addEventListener('submit', async function(event) {
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
                        text: 'Komentar anda sangat berharga bagi kami!.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        this.reset();
                    });
                } else {
                    Swal.fire({
                        title: 'Uppsss! 🫣',
                        text: 'Anda harus login terlebih dahulu untuk memberikan komentar.',
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
