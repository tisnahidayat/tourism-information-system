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
        <h1>Kategori</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item active"><a href="/dashboard/kategori">{{ $title }}</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="mt-2 card-head d-flex justify-content-between align-items-center">
                        <h4 class="m-0">Daftar Kategori</h4>
                        <a href="/dashboard/kategori/create" class="btn btn-icon icon-left btn-primary ml-auto">
                            <i class="fas fa-plus"></i> Tambah Kategori
                        </a>
                    </div>
                    <div class="card-body-data">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>Kategori</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td><img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"
                                                    width="100%" height="130px" style="object-fit: cover;">
                                            </td>
                                            <td>
                                                <a href="/dashboard/kategori/{{ $item->slug }}/edit"
                                                    class="btn btn-success" data-toggle="tooltip" data-placement="top"
                                                    title="Ubah"><i class="fas fa-edit"></i></a>
                                                <form action="/dashboard/kategori/{{ $item->slug }}" method="POST"
                                                    class="d-inline" id="deleteForm">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                                        data-placement="top" title="delete" onclick="confirmDelete(event)"
                                                        {{ $item->destinasi_count >= 1 ? 'disabled' : '' }}>
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
