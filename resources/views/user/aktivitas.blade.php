<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Aktivitas Mahasiswa Jurusan Teknik Informatika</title>
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
                        <a class="nav-link" href="{{ route('user.berita') }}">Berita</a>
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
        <h1 class="text-center">Aktivitas Mahasiswa  Politeknik Negeri Bengkalis</h1>
        <hr>

        <!-- Aktivitas Mahasiswa -->
        <div class="row">
            <!-- Loop through each news item -->
            @foreach ($aktivitas_item as $aktivitas)
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div style="height: 50vh; overflow: hidden;">
                            <img src="{{ asset('/images/' . $aktivitas->gambar) }}" class="card-img-top"
                                style="height: 100%; width: auto; object-fit: cover;" alt="{{ $aktivitas->gambar }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $aktivitas->judul_aktivitas }}</h5>
                            <p class="card-text">{{ $aktivitas->isi_aktivitas }}</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Sertakan skrip JavaScript Bootstrap (JQuery dan Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
