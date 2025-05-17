@extends('layouts.main')

@section('content')

    {{-- Select2 Destinasi --}}
    <img src="{{ asset('img/wisata.jpg') }}" class="image-content" alt="wisata">
    <div class="container-fluid mt-3">
        <form id="filterForm" method="POST" class="row g-3 justify-content-sm-center justify-content-md-end">
            @csrf
            <div class="col-12 col-sm-4 col-md-3 col-lg-4">
                <div class="form-group">
                    <select id="kecamatan" class="form-control select2" name="kecamatan">
                        <option value="">Semua Kecamatan</option>
                        @foreach ($kecamatan as $item)
                            <option value="{{ $item->id }}" @if (old('kecamatan') == $item->id) selected @endif>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-3 col-lg-4">
                <div class="form-group">
                    <select id="destinasi" class="form-control select2" name="destinasi" disabled>
                        <option>Semua Destinasi</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-auto col-lg-auto">
                <button type="submit" id="filterButton" class="btn btn-primary mb-3 p-2 font-weight-bolder px-4"
                    name="cari">Cari</button>
            </div>
        </form>
    </div>

    {{-- Destinasi --}}
    <div class="container mx-auto mb-3">
        <h4 class="mb-4">{{ $temp }}</h3>
            <div class="row">
                @if ($destinasi->count() > 0)
                    @foreach ($destinasi as $item)
                        <div class="col-12 col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card card-primary h-100 shadow">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                    style="object-fit: cover" height="200" alt="{{ $item->nama }}">
                                <a href="/wisata?kategori={{ $item->kategori->slug }}"
                                    class="position-absolute py-1 px-2 text-decoration-none text-white btn-dark"
                                    style=" opacity: 0.5;"><small>{{ $item->kategori->nama }}</small></a>
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $item->nama }}</h5>
                                    <div class="truncate-text mb-3">
                                        <p class="card-text">{{ $item->deskripsi }}</p>
                                    </div>
                                    <a href="/wisata/{{ $item->slug }}" class="btn btn-icon icon-left btn-info"><i
                                            class="fas fa-info-circle"></i> Selengkapnya ...</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 mx-auto text-center">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Mohon maaf,</strong> tujuan wisata anda belum tersedia saat ini😣.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-end">
                {{ $destinasi->links() }}
            </div>
    </div>



@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            function fetchDestinations(kecamatanId) {
                var url = "{{ url('pilih-destinasi') }}/" + kecamatanId;

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        var selectDestinasi = $('#destinasi');
                        selectDestinasi.empty(); // Clear existing options
                        if (data.length > 0) {
                            selectDestinasi.prop('disabled', false); // Enable destination select
                            selectDestinasi.append('<option value="">Semua Destinasi</option>')
                            $.each(data, function(index, option) {
                                selectDestinasi.append('<option value="' + option.id + '">' +
                                    option.nama + '</option>');
                            });
                        } else {
                            selectDestinasi.prop('disabled',
                                true); // Disable destination select if no options available
                            selectDestinasi.append('<option value="">Tidak ada destinasi</option>');
                        }
                        selectDestinasi.trigger('change'); // Trigger change event to update Select2
                    }
                });
            }

            // Fetch destinations when a district is selected
            $('#kecamatan').on('change', function() {
                var kecamatanId = $(this).val();
                if (kecamatanId === "") {
                    $('#destinasi').prop('disabled', true).empty().append(
                        '<option value="">Semua Destinasi</option>');
                } else {
                    fetchDestinations(kecamatanId);
                }
            });
        });
    </script>
@endpush
