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
                <h4>Edit Destinasi Wisata</h4>
            </div>
            <div class="card-body">
                <form id="filterForm" action="/dashboard/wisata/{{ $destinasi->slug }}" method='post'
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Destinasi</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            value="{{ old('nama', $destinasi->nama) }}" required autofocus>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group d-none">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control"
                            value="{{ old('slug', $destinasi->slug) }}">
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="kategori" class="form-control selectric" name="kategori">
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @if (old('kategori', $destinasi->kategori->id) == $item->id) selected @endif>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select id="kecamatan" class="form-control select2" name="kecamatan">
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item->id }}" @if (old('kecamatan', $destinasi->id_kecamatan) == $item->id) selected @endif>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('kecamatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control" name="deskripsi" required>{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <textarea style="height: 80px" id="lokasi" class="form-control" name="lokasi" required>{{ old('lokasi', $destinasi->lokasi) }}</textarea>
                        @error('lokasi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-control"
                            value="{{ old('harga', $destinasi->harga) }}" required>
                        @error('harga')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control">
                    </div>
                    <div class="form-group">
                        @if ($destinasi->gambar)
                            <img src="{{ asset('storage/' . $destinasi->gambar) }}" alt="Current Image" width="250px"
                                height="150px" style="object-fit: cover;" id="current-image">
                        @else
                            <img src="{{ asset('img/asset/none.jpg') }}" alt="No Image" width="250px" height="150px"
                                style="object-fit: cover;" id="current-image">
                        @endif
                        <img id="image-preview" style="display: none; margin-top: 10px; object-fit: cover;" width="250px"
                            height="150px" alt="Image Preview">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        const nama = document.querySelector('#nama');
        const slugInput = document.querySelector('#slug');
        const gambarInput = document.querySelector('#gambar');
        const currentImage = document.querySelector('#current-image');
        const imagePreview = document.querySelector('#image-preview');

        // Function to update image preview
        function updateImagePreview() {
            const file = gambarInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    currentImage.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
        gambarInput.addEventListener('change', updateImagePreview);

        nama.addEventListener('change', function() {
            fetch('/dashboard/wisata/checkSlug?nama=' + nama.value)
                .then(response => response.json())
                .then(data => slugInput.value = data.slug)
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
