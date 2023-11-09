<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.c
ss">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrapicons@1.10.5/font/bootstrap-icons.css">
    <title>Edit Data lulusan</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Politeknik Negeri Bengkalis | D-IV Rekayasa Perangkat Lunak</a>
        </div>
    </nav>
    <div class="container">
        <a href="{{ route('admin.lulusan') }}">
            <i class="bi-arrow-left h4" style="text-decoration: none">Back</i>
        </a>
        <div class="container mt-3">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fadeshow" role="alert">
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
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card mt-4" style="width: 800px">
                    <div class="card-body">
                        <h5 class="card-title text-center">Update Data
                            lulusan</h5>
                        <form action="/postEditLulusan/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-4">
                                <label class="text-secondary mb-2">Kode
                                    lulusan</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="id" required value="{{ $data->id }}">
                                <span class="text-danger">
                                    @error('id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Nama Lulusan</label>
                                <input type="text" class="form-controlborder border-secondary form-control"
                                    name="nama" autocomplete="off" required value="{{ $data->nama }}">
                                <span class="text-danger">
                                    @error('nama')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb2">NIM</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="nim" required value="{{ $data->nim }}">
                                <span class="text-danger">
                                    @error('nim')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb2">Prodi</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="prodi" required value="{{ $data->prodi }}">
                                <span class="text-danger">
                                    @error('prodi')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Tahun Lulus</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="tahunLulus" required value="{{ $data->tahun_lulus}}">
                                <span class="text-danger">
                                    @error('tahunLulus')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Foto</label>
                                <input class="form-control mb-2" placeholder="Nama file lama: {{ $data->gambar }}"
                                    disabled>
                                <input class="form-control" type="file" name="gambar">
                                <div class="form-text">Maksimal ukuran Foto lulusan 5MB</div>
                                <img class="mt-3" style="width: 100px" src="{{ asset('/images/' . $data->gambar) }}"
                                    alt="foto">
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">Pekerjaan Sekarang</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="pekerjaanSekarang" required value="{{ $data->pekerjaan_sekarang}}">
                                <span class="text-danger">
                                    @error('pekerjaanSekarang')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            <div class="form-group mt-1">
                                <label class="text-secondary mb-2">pendidikan Lanjutan</label>
                                <input type="text" class="form-control border border-secondary form-control"
                                    name="pendidikanLanjutan" required value="{{ $data->pendidikan_lanjutan}}">
                                <span class="text-danger">
                                    @error('pendidikanLanjutan')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div><br>
                            </div><br>
    
                            <button type="submit" class="btn btn-success mt-5">Update Data lulusan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><br><br><br><br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
