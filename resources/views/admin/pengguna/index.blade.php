@extends('layouts.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="section-header">
        <h1>Pengguna</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item active"><a href="/dashboard/pengguna">{{ $title }}</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="mt-2 card-head d-flex justify-content-between align-items-center">
                        <h4 class="m-0">Daftar Pengguna</h4>
                        <a href="/dashboard/pengguna/create" class="btn btn-icon icon-left btn-primary ml-auto">
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </a>
                    </div>

                    <div class="card-body-data">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pengunjung-tab" data-toggle="tab" href="#pengunjung"
                                    role="tab" aria-controls="pengunjung" aria-selected="true">Pengunjung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                                    aria-controls="admin" aria-selected="false">Admin</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="pengunjung" role="tabpanel"
                                aria-labelledby="pengunjung-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach ($pengguna as $item)
                                                @if ($item->role === 'user')
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td>{{ $item->username }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td class="text-center">
                                                            <a href="/dashboard/pengguna/{{ $item->id }}/edit"
                                                                class="btn btn-success" data-toggle="tooltip"
                                                                data-placement="top" title="Ubah"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form action="/dashboard/pengguna/{{ $item->id }}"
                                                                method="POST" class="d-inline" id="deleteForm">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="delete" onclick="confirmDelete(event)">
                                                                    <i class="fas fa-trash" style="padding: 2px;"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Email</th>
                                                <th style="width: 95px">Created At</th>
                                                <th class="text-center" style="width: 50px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach ($pengguna as $item)
                                                @if ($item->role === 'admin')
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td>{{ $item->username }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td class="text-center">
                                                            <a href="/dashboard/pengguna/{{ $item->id }}/edit"
                                                                class="btn btn-success" data-toggle="tooltip"
                                                                data-placement="top" title="Ubah"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form action="/dashboard/pengguna/{{ $item->id }}"
                                                                method="POST" class="d-inline" id="deleteForm">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="delete" onclick="confirmDelete(event)">
                                                                    <i class="fas fa-trash" style="padding: 2px;"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        </script>
    @endsection
