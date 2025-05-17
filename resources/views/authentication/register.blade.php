@extends('layouts.auth')

@section('content')
    <img src="{{ asset('img/register.jpg') }}" class="position-absolute w-100" style="object-fit: cover; height: 100%"
        alt="">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-7 col-md-9 mx-auto" style="margin-top: 50px;">
                <div class="card card-primary">
                    <h4 class="px-4 pt-3 text-primary">Register</h4>
                    <div class="card-body">
                        <form action="/register" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="password" class="d-block">Kata Sandi</label>
                                    <input id="password" type="password"
                                        class="form-control pwstrength @error('password') is-invalid @enderror"
                                        data-indicator="pwindicator" name="password">
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="password2" class="d-block">Ulangi Kata Sandi</label>
                                    <input id="password2" type="password"
                                        class="form-control @error('repassword') is-invalid @enderror" name="repassword">
                                    @error('repassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
