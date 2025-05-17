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
                <h4>Tambah Pengguna</h4>
            </div>
            <div class="card-body">
                <form id="filterForm" method="POST" action="/dashboard/pengguna">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="role">Role</label>
                            <input type="text" id="role" name="role" class="form-control" required autofocus>
                        </div>
                        <div class="form-group col-6">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
