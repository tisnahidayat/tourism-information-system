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
        <h1>Hotel</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item active"><a href="/dashboard/hotel">{{ $title }}</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="mt-2 card-head d-flex justify-content-between align-items-center">
                        <h4 class="m-0">Daftar Hotel</h4>
                        <a href="/dashboard/hotel/create" class="btn btn-icon icon-left btn-primary ml-auto">
                            <i class="fas fa-plus"></i> Tambah Hotel
                        </a>
                    </div>

                    <div class="card-body-data">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10px">
                                            No
                                        </th>
                                        <th style="width: 50px">Nama</th>
                                        <th style="width: 150px">Deskripsi</th>
                                        <th style="width: 150px">Gambar</th>
                                        <th style="width: 80px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hotel as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>
                                                <div class="d-inline-block"
                                                    style="width: 100%; max-height: 11.5em; overflow-y: auto;">
                                                    <span class="d-block"
                                                        style="overflow: hidden; text-overflow: ellipsis;">
                                                        {!! $item->deskripsi !!}
                                                    </span>
                                                </div>
                                            </td>
                                            <td><img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                                    width="100%" height="150px" style="object-fit: cover;">
                                            </td>
                                            <td class="text-center">
                                                <a href="/dashboard/hotel/{{ $item->slug }}" class="btn btn-primary"
                                                    data-toggle="tooltip" data-placement="top" title="Detail"><i
                                                        class="fas fa-eye"></i></a>
                                                <a href="/dashboard/hotel/{{ $item->slug }}/edit" class="btn btn-success"
                                                    data-toggle="tooltip" data-placement="top" title="Ubah"><i
                                                        class="fas fa-edit"></i></a>
                                                <form action="/dashboard/hotel/{{ $item->slug }}" method="POST"
                                                    class="d-inline" id="deleteForm">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                        data-placement="top" title="delete" onclick="confirmDelete(event)">
                                                        <i class="fas fa-trash" style="padding: 2px;"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
