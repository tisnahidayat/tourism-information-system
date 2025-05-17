@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item"><a href="/dashboard/hotel">Hotel</a></div>
            <div class="breadcrumb-item active">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-head">
                <h4>Edit Hotel</h4>
            </div>
            <div class="card-body">
                <form id="filterForm" action="/dashboard/hotel/{{ $hotel->slug }}" method='post'
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Hotel</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            value="{{ old('nama', $hotel->nama) }}" required autofocus>
                        @error('nama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group d-none">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control"
                            value="{{ old('slug', $hotel->slug) }}">
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" id="deskripsi" name="deskripsi" class="form-control"
                            value="{{ old('deskripsi', $hotel->deskripsi) }}">
                        @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control"
                            value="{{ old('lokasi', $hotel->lokasi) }}">
                        @error('lokasi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control">
                    </div>
                    <div class="form-group">
                        @if ($hotel->gambar)
                            <img src="{{ asset('storage/' . $hotel->gambar) }}" alt="Current Image" width="250px"
                                height="150px" style="object-fit: cover;" id="current-image">
                        @else
                            <img src="{{ asset('img/asset/none.jpg') }}" alt="No Image" width="250px" height="150px"
                                style="object-fit: cover;" id="current-image">
                        @endif
                        <img id="image-preview" style="display: none; margin-top: 10px; object-fit: cover;" width="250px"
                            height="150px" alt="Image Preview">
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
