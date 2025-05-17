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
                <h4>Edit Blog Post</h4>
            </div>
            <div class="card-body">
                <form id="editForm" action="/dashboard/posting/{{ $post->slug }}" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control"
                            value="{{ old('judul', $post->judul) }}" required autofocus>
                        @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group d-none">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control"
                            value="{{ old('slug', $post->slug) }}">
                        @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="kategori" class="form-control selectric" name="kategori">
                            <option value="Wisata" {{ $post->id_kategori == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                            <option value="Event" {{ $post->id_kategori == 'Event' ? 'selected' : '' }}>Event</option>
                            <option value="Kuliner" {{ $post->id_kategori == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                            <option value="Seni Budaya" {{ $post->id_kategori == 'SeniBudaya' ? 'selected' : '' }}>
                                SeniBudaya</option>
                            <option value="Sejarah" {{ $post->id_kategori == 'Sejarah' ? 'selected' : '' }}>Sejarah
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control" style="height: 200px" name="deskripsi" required>{{ old('deskripsi', $post->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" id="gambar" name="gambar" class="form-control">
                    </div>
                    <div class="form-group">
                        @if ($post->gambar)
                            <img src="{{ asset('storage/' . $post->gambar) }}" alt="Current Image" width="250px"
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
