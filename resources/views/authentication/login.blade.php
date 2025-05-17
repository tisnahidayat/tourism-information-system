@extends('layouts.auth')

@section('content')
    <section class="section">
        <div class="d-flex flex-wrap align-items-stretch">
            <div class="col-lg-4 col-md-5 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <img src="/img/logo.png" alt="logo" width="70" class="mx-auto">
                    <h4 class="text-dark font-weight-normal">Selamat datang di <span class="font-weight-bold">SiParKar</span>
                    </h4>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('login.authenticate') }}" method="POST" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Email</label>
                            </div>
                            <input id="password" type="email" class="form-control" name="email" tabindex="1"
                                required>
                            <div class="invalid-feedback">
                                Tolong isi email anda
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                required>
                            <div class="invalid-feedback">
                                Tolong isi kata sandi anda
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-block">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right btn-block"
                                    tabindex="4">
                                    Masuk
                                </button>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            Belum punya akun? <a href="/register">Buat yang baru</a>
                        </div>
                    </form>
                    <div class="text-center mt-4 text-small">
                        Copyright &copy; 2024 Dinas Pariwisata Kabupaten Karawang
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block d-lg-block col-md-7 order-md-2 col-lg-8 col-12 order-lg-2 order-1 vh-100 background-walk-y position-relative overlay-gradient-bottom"
                data-background="/img/auth.jpg">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-3">
                        <div class="mb-3 pb-3">
                            <h1 id="greeting" class="mb-2 display-4 font-weight-bold text-lg text-md"></h1>
                            <h5 class="font-weight-normal text-muted-transparent">Karawang, Jawa Barat, Indonesia</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function updateGreeting() {
            const greetingElement = document.getElementById('greeting');
            const now = new Date();
            const hours = now.getHours();
            let greetingText = '';

            if (hours < 12) {
                greetingText = 'Good Morning';
            } else if (hours < 18) {
                greetingText = 'Good Afternoon';
            } else {
                greetingText = 'Good Evening';
            }

            greetingElement.textContent = greetingText;
        }

        window.onload = updateGreeting;
    </script>
@endsection
