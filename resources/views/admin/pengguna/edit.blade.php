@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item"><a href="/dashboard/pengguna">Pengguna</a></div>
            <div class="breadcrumb-item active">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-head">
                <h4>Edit Pengguna</h4>
            </div>
            <div class="card-body">
                <form id="filterForm" action="/dashboard/pengguna/{{ $pengguna->id }}" method='post'>
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                value="{{ old('username', $pengguna->username) }}" required autofocus>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="role">Role</label>
                            <input type="text" id="role" name="role" class="form-control"
                                value="{{ old('role', $pengguna->role) }}" required autofocus>
                            @error('role')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control"
                                value="{{ old('email', $pengguna->email) }}" required autofocus>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required autofocus>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');

        nama.addEventListener('change', function() {
            fetch('/dashboard/kategori/checkSlug?nama=' + nama.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
