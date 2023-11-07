<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Aktivitas Mahasiswa Jurusan RPL</title>
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
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-4">
        <h1 class="text-center">Aktivitas Mahasiswa Jurusan RPL</h1>
        <hr>

        <!-- Aktivitas Mahasiswa -->
        <div class="row">
            <!-- Aktivitas 1 -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="/image/aktif1.jpg" class="card-img-top" alt="Foto Aktivitas 1">
                    <div class="card-body">
                        <h5 class="card-title">Pekan Kegiatan Mahasiswa (PKM) Politeknik Negeri Bengkalis Resmi Dibuka oleh Wakil Direktur I</h5>
                        <p class="card-text">Pekan Kegiatan Mahasiswa (PKM) merupakan salah satu program kemahasiswaan yang bertujuan untuk meningkatkan kreativitas mahasiswa. PKM juga ddiharapkan dapat menjadi media bagi mahasiswa untuk beristirahat sejenak dari rutinitas kuliah.</p>
                        <a href="/img/a.PNG" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Aktivitas 2 -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="/image/aktif2.jpeg" class="card-img-top" alt="Foto Aktivitas 2">
                    <div class="card-body">
                        <h5 class="card-title">Polbeng Raih Kemenangan Mengesankan pada Ajang KKCTBN 2023
</h5>
                        <p class="card-text">Politeknik Negeri Bengkalis (Polbeng) meraih kemenangan yang mengesankan pada ajang Kontes Kapal Cepat Tak Berawak Nasional (KKCTBN) 2023 yang diselenggarakan oleh Universitas Indonesia (UI) dengan dukungan dari Pusat Prestasi Nasional (Puspresnas) dan Balai Pengembangan Talenta Indonesia (BPTI) bertempat di Kampus UI, Depok, Jawa Barat</p>
                        <a href="#" class="btn btn-primary">Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Aktivitas Lainnya di sini -->

        </div>
    </div>

    <!-- Sertakan skrip JavaScript Bootstrap (JQuery dan Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>