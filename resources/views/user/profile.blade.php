<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Profil Lulusan</title>
    <style>
        .image-resize {
    height: 200px; /* Adjust the height as needed */
    width: 200px; /* Adjust the width as needed */
    object-fit: cover;
}

    </style>
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
        <h1 class="text-center">Profil Lulusan</h1>
        <hr>
    
        <!-- Profil Lulusan -->
<div class="row justify-content-center">
    <!-- Loop through each graduate item -->
    @foreach ($lulusan_item as $lulusan)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('/images/' . $lulusan->gambar) }}" class="card-img-top image-resize" alt="{{ $lulusan->gambar }}">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $lulusan->nama }}</h5>
                    <p class="card-text text-center">{{ 'Lulus pada tanggal ' . $lulusan->tahun_lulus }}</p>
                </div>
                <div class="card-footer d-flex justify-content-center">
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