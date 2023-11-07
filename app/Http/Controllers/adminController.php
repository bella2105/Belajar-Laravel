<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Charts\ChartPeminjaman;
use Illuminate\Support\Facades\DB;
use App\Models\berita;
use App\Models\lulusan;

class adminController extends Controller
{
    public function beritaAdmin()
    {
        return view('admin.berita');
    }
    public function lulusanAdmin()
    {
        return view('admin.lulusan');
    }

    public function tambah()
    {
        return view('admin.tambah');
    }
    public function postTambahAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'jenisKelamin' => 'required',
            'password' => 'required|min:8|max:20|confirmed'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = 'admin';
        $user->jenis_kelamin = $request->jenisKelamin;
        $user->password = Hash::make($request->password);

        $user->save();

        if ($user) {
            return back()->with('success', 'Admin baru berhasil ditambah!');
        } else {
            return back()->with('failed', 'Gagal menambah admin baru!');
        }
    }


    public function editAdmin($id)
    {
        $data = User::find($id);
        return view('admin.edit', compact('data'));
    }
    public function postEditAdmin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'jenisKelamin' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->jenis_kelamin = $request->jenisKelamin;
        $user->save();
        if ($user) {
            return back()->with('success', 'Data admin berhasil di
update!');
        } else {
            return back()->with('failed', 'Gagal mengupdate data admin!');
        }
    }

    public function deleteAdmin($id)
    {
        $data = User::find($id);
        $data->delete();

        if ($data) {
            return back()->with('success', 'Data berhasil dihapus!');
        } else {
            return back()->with('failed', 'Data gagal dihapus!');
        }
    }

    public function adminBuku(Request $request)
    {
        $search = $request->input('search');
        $data = Buku::where(function ($query) use ($search) {
            $query->where('judul_buku', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.buku', compact('data'));
    }
    public function tambahBuku()
    {
        return view('admin.tambahBuku');
    }
    public function postTambahBuku(Request $request)
    {
        $request->validate([
            'kodeBuku' => 'required',
            'judulBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required|date',
            'gambar' => 'required|image|max:5120',
            'deskripsi' => 'required',
            'kategori' => 'required',
        ]);
        $buku = new Buku;
        $buku->kode_buku = $request->kodeBuku;
        $buku->judul_buku = $request->judulBuku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahunTerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori = $request->kategori;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $buku->gambar = $filename;
        }
        $buku->save();
        if ($buku) {
            return back()->with('success', 'Buku baru berhasil
ditambahkan!');
        } else {
            return back()->with('failed', 'Data gagal ditambahkan!');
        }
    }
    public function editBuku($id)
    {
        $data = Buku::find($id);
        return view('admin.editBuku', compact('data'));
    }

    public function postEditBuku(Request $request, $id)
    {
        $request->validate([
            'kodeBuku' => 'required',
            'judulBuku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required',
            'gambar' => 'image|max:5120',
            'deskripsi' => 'required',
            'kategori' => 'required'
        ]);

        $buku = Buku::find($id);

        $buku->kode_buku = $request->kodeBuku;
        $buku->judul_buku = $request->judulBuku;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahunTerbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori = $request->kategori;

        if ($request->hasFile('gambar')) {
            $filepath = 'images/' . $buku->gambar;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $buku->gambar = $filename;
        }

        $buku->save();

        if ($buku) {
            return back()->with('success', 'Buku berhasil diupdate!');
        } else {
            return back()->with('failed', 'Buku gagal diupdate!');
        }
    }
    public function deleteBuku($id)
    {
        $buku = Buku::find($id);
        $filepath = 'images/' . $buku->gambar;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $buku->delete();
        if ($buku) {
            return back()->with('success', 'Data buku berhasil di
hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data buku!');
        }
    }

    public function adminPeminjaman(Request $request, ChartPeminjaman $chartPeminjaman)
    {
        $chart = $chartPeminjaman->build();
        $search = $request->input('search');
        $data = Peminjaman::where(function ($query) use ($search) {
            $query->where('id_user', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.peminjaman', compact('data', 'chart'));
    }
    public function tambahPeminjaman()
    {
        return view('admin.tambahPeminjaman');
    }
    public function postTambahPeminjaman(Request $request)
    {
        $request->validate([
            'idUser' => 'required',
            'kodeBuku' => 'required|int',
            'tanggalPeminjaman' => 'required|date',
            'tanggalPengembalian' => 'required|date'
        ]);
        $peminjaman = new Peminjaman;
        $peminjaman->id_user = $request->idUser;
        $peminjaman->id_buku = $request->kodeBuku;
        $peminjaman->tanggal_pinjam = $request->tanggalPeminjaman;
        $peminjaman->tanggal_kembali = $request->tanggalPengembalian;
        $peminjaman->status = 'Belum Dikembalikan';
        $peminjaman->save();
        if ($peminjaman) {
            return back()->with('success', 'Data peminjaman berhasil
ditambahkan!');
        } else {
            return back()->with('failed', 'Gagal menambahkan data
peminjaman!');
        }
    }
    public function editPeminjaman($id)
    {
        $data = Peminjaman::find($id);
        return view('admin/editPeminjaman', compact('data'));
    }
    public function postEditPeminjaman(Request $request, $id)
    {
        $request->validate([
            'idUser' => 'required',
            'kodeBuku' => 'required|int',
            'tanggalPeminjaman' => 'required',
            'tanggalPengembalian' => 'required',
            'status' => 'required'
        ]);
        $peminjaman = Peminjaman::find($id);
        $peminjaman->id_user = $request->idUser;
        $peminjaman->id_buku = $request->kodeBuku;
        $peminjaman->tanggal_pinjam = $request->tanggalPeminjaman;
        $peminjaman->tanggal_kembali = $request->tanggalPengembalian;
        $peminjaman->status = $request->status;
        $peminjaman->save();
        if ($peminjaman) {
            return back()->with('success', 'Data peminjaman berhasil di
update!');
        } else {
            return back()->with('failed', 'Gagal mengupdate data
peminjaman!');
        }
    }
    public function deletePeminjaman($id)
    {
        $data = Peminjaman::find($id);
        $data->delete();
        if ($data) {
            return back()->with('success', 'Data peminjaman berhasil di
hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data
peminjaman!');
        }
    }
    public function detailPeminjaman($id_peminjaman, $id_user, $id_buku)
    {
        $detailPeminjaman = Peminjaman::select('peminjaman.*', 'buku.*', 'users.*')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id')
            ->join('users', 'peminjaman.id_user', '=', 'users.id')
            ->where('peminjaman.id', $id_peminjaman)
            ->where('buku.id', $id_buku)
            ->where('users.id', $id_user)
            ->first();

        if (!$detailPeminjaman) {
            abort(404, 'Data tidak ditemukan');
        }

        return view('admin.detailPeminjaman', compact('detailPeminjaman'));
    }
    public function cetakDataPeminjaman()
    {
        $data = DB::table('peminjaman')
            ->join('users', 'users.id', '=', 'peminjaman.id_user')
            ->join('buku', 'buku.id', '=', 'peminjaman.id_buku')
            ->select('peminjaman.*', 'users.name', 'buku.judul_buku')
            ->get();
        $pdf = PDF::loadView('admin.cetakPeminjaman', ['data' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    // Function untuk menambahkan berita baru
    public function postBerita(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required',
            'tanggal' => 'required',
            'penulis' => 'required',
            'gambar' => 'image|max:5120',
            'isi_berita' => 'required'
        ]);

        $data = new berita;

        $data->judul_berita = $request->judul_berita;
        $data->tanggal = $request->tanggal;
        $data->penulis = $request->penulis;
        $data->isi_berita = $request->isi_berita;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $data->gambar = $filename;
        }

        $data->save();

        if ($data) {
            return back()->with('success', 'Berita baru, berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Berita baru, gagal ditambahkan!');
        }
    }

    // Function untuk menambahkan lulusan baru
    public function postLulusan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'prodi' => 'required',
            'tahun_lulus' => 'required',
            'pekerjaan_sekarang' => 'required',
            'pendidikan_lanjutan' => 'required'
        ]);

        $data = new lulusan;

        $data->nama = $request->nama;
        $data->nim = $request->nim;
        $data->prodi = $request->prodi;
        $data->tahun_lulus = $request->tahun_lulus;
        $data->pekerjaan_sekarang = $request->pekerjaan_sekarang;
        $data->pendidikan_lanjutan = $request->pendidikan_lanjutan;

        $data->save();

        if ($data) {
            return back()->with('success', 'Data lulusan baru, berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data lulusan baru, gagal ditambahkan!');
        }
    }
}
