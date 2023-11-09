<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Lulusan</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.home') }}">Politeknik Negeri Bengkalis |
                D-IV Rekayasa Perangkat Lunak</a>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h4 class="text-secondary">Selamat Datang {{ Auth::user()->name }}</h4>
            </div>
            <div class="col"></div>
            <div class="col-1"><a href="{{ route('logout') }}" style="text-decoration: none">
                    <p class="text-end text-black fw-semibold">Logout</p>
                </a></div>
        </div>
        <div class="row mt-3">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
                            </h5>
                        </li>
                        <li class="nav-item" style="margin-left: 30px">
                            <h5>
                                <a class="nav-link" href="{{ route('admin.buku') }}">Buku</a>
                            </h5>
                        </li>
                        <li class="nav-item" style="margin-left: 30px">
                            <h5>
                                <a class="nav-link" href="{{ route('admin.peminjaman') }}">Peminjaman</a>
                            </h5>
                        </li>
                        <li class="nav-item" style="margin-left: 30px">
                            <h5>
                                <a class="nav-link" href="{{ route('admin.berita') }}">Berita</a>
                            </h5>
                        </li>
                        <li class="nav-item" style="margin-left: 30px">
                            <h5>
                                <a class="nav-link active" href="{{ route('admin.lulusan') }}">Lulusan</a>
                            </h5>
                        </li>
                        <li class="nav-item" style="margin-left: 30px">
                            <h5>
                                <a class="nav-link" href="{{ route('admin.aktivitas') }}">Aktivitas</a>
                            </h5>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container mt-3">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs- dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::get('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs- dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="row mt-4">
            <div class="col"></div>
            <div class="col-6">
                <form action="{{ route('admin.lulusan') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="search" class="form-control rounded" placeholder="Cari nama lulusan"
                            aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" class="btn btn-outline-primary">search</button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col-2">
                <a class="btn btn-success" href="{{ route('admin.tambahLulusan') }}"
                    style="text-decoration: none; margin-left: 30px">Tambah
                    Data
                    +</a>
            </div>
        </div>
        <table class="table" style="margin-top: 10px">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    <th scope="col">PRODI</th>
                    <th scope="col">Tahun Lulus</th>
                    <th scope="col">Pekerjaan Sekarang</th>
                    <th scope="col">Pendidikan Lanjutan</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($data as $index => $lulusan)
                    <tr>
                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                        <td>{{ $lulusan->nama }}</td>
                        <td>{{ $lulusan->nim }}</td>
                        <td>{{ $lulusan->prodi }}</td>
                        <td>{{ $lulusan->tahun_lulus }}</td>
                        <td>{{ $lulusan->pekerjaan_sekarang }}</td>
                        <td>{{ $lulusan->pendidikan_lanjutan }}</td>
                        <td>
                            <img style="width: 50px" src="{{ asset('/images/' . $lulusan->gambar) }}"
                                alt="foto lulusan">
                        </td>
                        <td>
                            <a class="btn btn-outline-warning" href="/admin/editLulusan/{{ $lulusan->id }}">Edit</a>
                            <a class="btn btn-outline-danger" href="/admin/deleteLulusan/{{ $lulusan->id }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table><br>
        {{ $data->links() }}
    </div><br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
