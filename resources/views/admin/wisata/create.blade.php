@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item"><a href="/dashboard/wisata">Wisata</a></div>
            <div class="breadcrumb-item active">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-head">
                <h4>Tambah Destinasi Wisata</h4>
            </div>
            <div class="card-body">
                <form id="filterForm" method="POST" action="/dashboard/wisata" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Destinasi</label>
                        <input type="text" id="nama" name="nama"
                            class="form-control @error('nama') is-invalid @enderror" required autofocus>
                        @error('nama')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-none">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control"
                            value="{{ old('slug') }}">
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="kategori" class="form-control selectric" name="kategori">
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @if (old('kategori') == $item->id) selected @endif>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select id="kecamatan" class="form-control select2" name="kecamatan">
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item->id }}" @if (old('kecamatan') == $item->id) selected @endif>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required></textarea>
                        @error('deskripsi')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi"
                            class="form-control @error('lokasi') is-invalid @enderror" required>
                        @error('lokasi')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" id="harga" name="harga"
                            class="form-control  @error('harga') is-invalid @enderror" required>
                        @error('harga')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control">
                    </div>
                    <div class="form-group">
                        <img id="image-preview" style="display: none; margin-top: 10px; object-fit: cover;" width="250px"
                            height="150px" alt="Image Preview">
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slug = document.querySelector('#slug');
        const gambarInput = document.querySelector('#gambar');
        const imagePreview = document.querySelector('#image-preview');

        function updateImagePreview() {
            const file = gambarInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
        gambarInput.addEventListener('change', updateImagePreview);

        nama.addEventListener('change', function() {
            fetch('/dashboard/wisata/checkSlug?nama=' + nama.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
                .catch(error => console.error('Error:', error));
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
