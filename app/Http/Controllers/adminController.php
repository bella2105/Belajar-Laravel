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
use App\Models\Berita;
use App\Models\Lulusan;
use App\Models\Aktivitas;

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
        $users = User::all();
        $buku_item = Buku::all();
        return view('admin.tambahPeminjaman', compact('users', 'buku_item'));
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
        $pdf = PDF::loadView('admin.cetakPeminjaman', ['data' => $data]);
        return $pdf->stream();
    }

    // Function untuk menambahkan berita baru
    public function adminBerita(Request $request)
    {
        $search = $request->input('search');
        $data = Berita::where(function ($query) use ($search) {
            $query->where('judul_berita', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.berita', compact('data'));
    }
    public function tambahBerita()
    {
        return view('admin.tambahBerita');
    }
    public function postTambahBerita(Request $request)
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

    public function editBerita($id)
    {
        $data = Berita::find($id);
        return view('admin.editBerita', compact('data'));
    }

    public function postEditBerita(Request $request, $id)
    {
        $request->validate([
            'judul_berita' => 'required',
            'tanggal' => 'required',
            'penulis' => 'required',
            'gambar' => 'image|max:5120',   
            'isi_berita' => 'required'
        ]);

        $berita = Berita::find($id);

        $berita->judul_berita = $request->judul_berita;
        $berita->tanggal = $request->tanggal;
        $berita->penulis = $request->penulis;
        $berita->isi_berita = $request->isi_berita;

        if ($request->hasFile('gambar')) {
            $filepath = 'images/' . $berita->gambar;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $berita->gambar = $filename;
        }

        $berita->save();

        if ($berita) {
            return back()->with('success', 'Berita berhasil diupdate!');
        } else {
            return back()->with('failed', 'Berita gagal diupdate!');
        }
    }

    public function deleteBerita($id)
    {
        $berita = Berita::find($id);
        $filepath = 'images/' . $berita->gambar;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $berita->delete();
        if ($berita) {
            return back()->with('success', 'Data berita berhasil di
hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data berita!');
        }
    }

    // Function untuk menambahkan lulusan baru
    public function adminLulusan(Request $request)
    {
        $search = $request->input('search');
        $data = Lulusan::where(function ($query) use ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.lulusan', compact('data'));
    }
    public function tambahLulusan()
    {
        return view('admin.tambahLulusan');
    }
    public function postTambahLulusan(Request $request)
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
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $data->gambar = $filename;
        }
        $data->save();

        if ($data) {
            return back()->with('success', 'Data lulusan baru, berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data lulusan baru, gagal ditambahkan!');
        }
    }

    public function editLulusan($id)
    {
        $data = Lulusan::find($id);
        return view('admin.editLulusan', compact('data'));
    }

    public function postEditLulusan(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'prodi' => 'required',
            'tahunLulus' => 'required',
            'pekerjaanSekarang' => 'required',
            'pendidikanLanjutan' => 'required',
            'gambar' => 'image|max:5120',
        ]);

        $lulusan = Lulusan::find($id);

        $lulusan->nama = $request->nama;
        $lulusan->nim = $request->nim;
        $lulusan->prodi = $request->prodi;
        $lulusan->tahun_lulus = $request->tahunLulus;
        $lulusan->pekerjaan_sekarang = $request->pekerjaanSekarang;
        $lulusan->pendidikan_lanjutan = $request->pendidikanLanjutan;
        if ($request->hasFile('gambar')) {
            $filepath = 'images/' . $lulusan->gambar;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $lulusan->gambar = $filename;
        }
        $lulusan->save();

        if ($lulusan) {
            return back()->with('success', 'Lulusan berhasil diupdate!');
        } else {
            return back()->with('failed', 'Lulusan gagal diupdate!');
        }
    }
    public function deleteLulusan($id)
    {
        $lulusan = Lulusan::find($id);
        $filepath = 'images/' . $lulusan->gambar;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $lulusan->delete();
        if ($lulusan) {
            return back()->with('success', 'Data lulusan berhasil di
hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data lulusan!');
        }
    }

    public function adminAktivitas(Request $request)
    {
        $search = $request->input('search');
        $data = Aktivitas::where(function ($query) use ($search) {
            $query->where('judul_aktivitas', 'LIKE', '%' . $search . '%');
        })->paginate(5);
        return view('admin.aktivitas', compact('data'));
    }
    public function tambahAktivitas()
    {
        return view('admin.tambahAktivitas');
    }
    public function postTambahAktivitas(Request $request)
    {
        $request->validate([
            'judul_aktivitas' => 'required',
            'tanggal' => 'required',
            'penulis' => 'required',
            'gambar' => 'image|max:5120',
            'isi_aktivitas' => 'required'
        ]);

        $data = new Aktivitas;

        $data->judul_aktivitas = $request->judul_aktivitas;
        $data->tanggal = $request->tanggal;
        $data->penulis = $request->penulis;
        $data->isi_aktivitas = $request->isi_aktivitas;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $data->gambar = $filename;
        }

        $data->save();

        if ($data) {
            return back()->with('success', 'Aktivitas baru, berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Aktivitas baru, gagal ditambahkan!');
        }
    }

    public function editAktivitas($id)
    {
        $data = Aktivitas::find($id);
        return view('admin.editAktivitas', compact('data'));
    }

    public function postEditAktivitas(Request $request, $id)
    {
        $request->validate([
            'judul_aktivitas' => 'required',
            'tanggal' => 'required',
            'penulis' => 'required',
            'gambar' => 'image|max:5120',   
            'isi_aktivitas' => 'required'
        ]);

        $aktivitas = Aktivitas::find($id);

        $aktivitas->judul_aktivitas = $request->judul_aktivitas;
        $aktivitas->tanggal = $request->tanggal;
        $aktivitas->penulis = $request->penulis;
        $aktivitas->isi_aktivitas = $request->isi_aktivitas;

        if ($request->hasFile('gambar')) {
            $filepath = 'images/' . $aktivitas->gambar;
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $aktivitas->gambar = $filename;
        }

        $aktivitas->save();

        if ($aktivitas) {
            return back()->with('success', 'Aktivitas berhasil diupdate!');
        } else {
            return back()->with('failed', 'Aktivitas gagal diupdate!');
        }
    }

    public function deleteAktivitas($id)
    {
        $aktivitas = Aktivitas::find($id);
        $filepath = 'images/' . $aktivitas->gambar;
        if (File::exists($filepath)) {
            File::delete($filepath);
        }
        $aktivitas->delete();
        if ($aktivitas) {
            return back()->with('success', 'Data aktivitas berhasil di
hapus!');
        } else {
            return back()->with('failed', 'Gagal menghapus data aktivitas!');
        }
    }
}
