<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Berita Mahasiswa</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mr-auto" href="/">Politeknik Negeri Bengkalis | DIV Rekayasa Perangkat Lunak</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('berita') }}">Berita</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('aktivitas') }}">Aktivitas</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-4">
        <h1 class="text-center">Berita Mahasiswa</h1>
        <hr>

        <!-- Daftar Berita -->
        <div class="row">
            <!-- Berita 1 -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <img src="/image/polbeng1.jpeg" class="card-img-top" alt="Gambar Berita 1">
                    <div class="card-body">
                        <h5 class="card-title">Jurusan Teknik Informatika Polbeng Sukses Melaksanakan Pelatihan
                            Persiapan Uji Kompetensi Keahlian</h5>
                        <p class="card-text">pelatihan Android bagi pemula menggunakan MIT APP Inventor. Kegiatan yang
                            dilaksanakan mulai tanggal 10-29 Januari 2022 ini di ikuti oleh sekitar 21 orang siswa/
                            siswi dan sebanyak 2 orang guru pendamping dari sekolah SMK IT Zunur’ ain Aqila Zahra.

                            Direktur Politeknik Negeri Bengkalis (Polbeng), Johny Custer,S.T.,M.T dalam sambutannya
                            menyampaikan bahwa kegiatan ini bertujuan untuk meningkatkan kemampuan siswa/siswi dalam
                            bidang Android mengingat saat ini perkembangan IT sangat pesat.

                            Johny pun berharap keikutsertaan peserta pada pelatihan pelatihan ini bukan hanya sekedar
                            untuk mendapatkan sertifikat semata. Dengan mengikuti Pelatihan Android ini para peserta
                            diharapkan dapat terus berupaya untuk mengembangkan kompetensi dan kinerja dan dapat
                            memberikan manfaat dalam rangka peningkatan pengetahuan siswa.</p>
                        <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Berita 2 -->
            <div class="col-md-12">
                <div class="card mb-4">
                    <img src="/image/polbeng2.jpeg" class="card-img-top" alt="Gambar Berita 2">
                    <div class="card-body">
                        <h5 class="card-title">Jurusan Teknik Informatika Prodi Rekayasa Perangkat Lunak Menadakan
                            Kunjungan Industri Malaysia dan Singapura
                        </h5>
                        <p class="card-text">Malaysia adalah salah satu negara di Asia Tenggara yang memiliki sektor
                            industri yang berkembang pesat. Kunjungan industri ke Malaysia bisa memberikan wawasan yang
                            berharga tentang berbagai sektor ekonomi dan produksi di negara ini. </p>
                        <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Berita Lainnya di sini -->

        </div>
    </div>

    <!-- Sertakan skrip JavaScript Bootstrap (JQuery dan Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>