@extends('layouts.main')

@section('content')
    <style>
        ul.indented-list {
            list-style-position: inside;
            padding-left: 1.5em;
            /* Indent the entire list */
        }

        ul.indented-list li {
            text-indent: -1.5em;
            /* Negative indent to pull first line back */
            padding-left: 1.5em;
            /* Indent subsequent lines */
        }
    </style>
    <img src="img/kantor.jpg" class="image-content" alt="...">
    <div class="container mt-4">
        <div class="card">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h2>Profil</h2>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('img/logo.png') }}" style="width: 270px;" class="mx-auto float-right"
                                alt="">
                            <span class="text-primary font-weight-bold" style="font-size: 24px; display: block;">Visi</span>
                            <h6>"MEWUJUDKAN KARAWANG MANDIRI, BERMATABAT DAN SEJAKHTERA"</h6>
                            <span class="text-primary font-weight-bold" style="font-size: 24px; display: block;">Misi</span>
                            <h6>
                                <ol class="indented-list">
                                    <li>Terwujudnya sumberdaya manusia yang berkualitas dan berdaya saing.</li>
                                    <li>Terwujudnya ekonomi kerakyatan yang kreatif, produktif dan berdaya saing serta
                                        berbasis pada potensi lokal.</li>
                                    <li>Terwujudnya tata kelola lingkungan hidup yang aman, nyaman, dan mendukung proses
                                        pembangunan yang berkesinambungan.</li>
                                    <li>Terwujudnya tata kelola pemerintahan yang baik dan pelayanan publik yang
                                        berkualitas.</li>
                                </ol>
                            </h6>
                            <span class="text-primary font-weight-bold"
                                style="font-size: 24px; display: block;">Tentang</span>
                            <h6>Dinas Pariwisata dan Kebudayaan" (Disparbud) adalah badan pemerintah yang bertanggung jawab
                                atas pengembangan dan pengelolaan sektor pariwisata serta pelestarian dan pengembangan
                                kebudayaan di suatu wilayah, seperti provinsi, kabupaten, atau kota. Tugas utama Disparbud
                                biasanya meliputi promosi destinasi pariwisata, pengelolaan tempat-tempat wisata,
                                pemeliharaan warisan budaya, penyelenggaraan acara kebudayaan, dan berbagai kegiatan lain
                                yang berkaitan dengan pariwisata dan kebudayaan.
                            </h6>
                            <span class="text-primary font-weight-bold"
                                style="font-size: 24px; display: block;">Wilayah</span>
                            <h6>Wilayah Karawang terletak di Provinsi Jawa Barat, Indonesia. Kabupaten Karawang memiliki
                                luas sekitar 1.652,20 km² dan terbagi menjadi 30 kecamatan.
                            </h6>
                        </div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d358800.55793200055!2d107.12988067255988!3d-6.2654217727618295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69775e79e70e01%3A0x301576d14feb9e0!2sKarawang%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1720720848806!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0; padding: 0 25px" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
