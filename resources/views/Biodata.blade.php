<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sertakan stylesheet Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Biodata</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berita"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kegiatan"></a>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <section id="home" class="text-center py-5">
        <img src="{{ 'image/foto.jpg' }}" width="150" alt="Your name" class="rounded-circle">
        <h1>Bella Kurnia Amellia</h1>
        <p>Mahasiswa</p>
        <p>Hi, saya Bella kurnia Amellia, saya adalah Mahasiswa Politeknik Negeri Bengkalis.
            Prodi D4 RPL Jurusan Teknik informatika Saat ini sedang belajar Laravel di Lab Software Testing.
        </p>
    </section>

    <section id="cv" class="container py-5">
        <h2 class="text-center">Pengalaman dan Skill</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Skill</th>
                        <th>Pengalaman</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Kotlin </td>
                        <td>Java</td>
                    </tr>
                    <tr>
                        <td>Pernah Mengikuti HMTI </td>
                        <td>Pernah mengikuti organisaisi Osis</td>
                    </tr>
                    <!-- Tambahkan baris-baris tambahan sesuai dengan pengalaman Anda -->
                </tbody>
            </table>
        </div>
    </section>
    <section id="contact">
        <!-- Tambahkan informasi kontak Anda di sini -->
    </section>
    <section id="about">
        <!-- Tambahkan informasi tentang diri Anda di sini -->
    </section>
    <section id="login">
        <!-- Tambahkan form login atau informasi login di sini -->
    </section>
    <footer class="bg-primary text-white text-center py-3">
        Copyright 2023 @Bella Kurnia Amellia
    </footer>

    <!-- Sertakan skrip JavaScript Bootstrap (JQuery dan Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
