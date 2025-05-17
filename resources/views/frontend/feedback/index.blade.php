@extends('layouts.main')

@section('content')
    <img src="{{ asset('img/kontak.jpg') }}" class="image-content" alt="...">
    <div class="container-fluid mt-4">
        <div class="card p-1">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h4>Kritik dan Saran</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/kontak" id="feedbackForm">
                                @csrf
                                <div class="form-group">
                                    <label for="subject">Subjek</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        id="subject" name="subject" value="{{ old('subject') }}" required autofocus>
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="content">Kritik dan Saran</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" style="height: 70px" id="content" name="content"
                                        rows="4" required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card mt-2">
                        <div class="embed-responsive embed-responsive-16by9 rounded" width="50%" height= "100%">
                            <iframe class="embed-responsive-item rounded"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.639993538909!2d107.29037947366477!3d-6.310935693678362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6977d8fcb0c95d%3A0x21d3a3af019b7ed1!2sDinas%20Pariwisata%20Dan%20Kebudayaan%20Karawang!5e0!3m2!1sid!2sid!4v1711522273669!5m2!1sid!2sid"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('feedbackForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: this.method,
                    body: formData
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message);
                }

                Swal.fire({
                    title: 'Terima kasih! 😉',
                    text: 'Masukkan anda sangat berharga bagi kami!.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    this.reset();
                });

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Uppsss! 🫣',
                    text: error.message,
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login';
                    }
                });
            }
        });
    </script>
@endsection
