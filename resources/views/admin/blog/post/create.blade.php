@extends('layouts.dashboard')

@section('content')
    <div class="section-header">
        <h1>{{ $title }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
            <div class="breadcrumb-item"><a href="/dashboard/posting">Post</a></div>
            <div class="breadcrumb-item active">{{ $title }}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-head">
                <h4>Tambah Post</h4>
            </div>
            <div class="card-body">
                <form id="filterForm" method="POST" action="/dashboard/posting" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul') }}"
                            required autofocus>
                        @error('judul')
                            <div class="text-danger">{{ $message }}</div>
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
                            <option value="Wisata">Wisata</option>
                            <option value="Event">Event</option>
                            <option value="Kuliner">Kuliner</option>
                            <option value="Seni Budaya">Seni Budaya</option>
                            <option value="Sejarah">Sejarah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <textarea id="deskripsi" class="form-control" name="deskripsi" required></textarea>
                        @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <img id="image-preview" style="display: none; margin-top: 10px; object-fit: cover;" width="250px"
                            height="150px" alt="Image Preview">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');
        const gambarInput = document.querySelector('#gambar');
        const imagePreview = document.querySelector('#image-preview');

        // Function to update image preview
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

        judul.addEventListener('change', function() {
            fetch('/dashboard/posting/checkSlug?judul=' + judul.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
