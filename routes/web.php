<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\adminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('biodata', [LoginRegisterController::class, 'biodata'])->name('biodata');
Route::post('/postRegister', [LoginRegisterController::class, 'postRegister'])->name('postRegister');
Route::post('/postLogin', [LoginRegisterController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/auth/login', [LoginRegisterController::class, 'login'])->name('auth.login');
    Route::get('/auth/register', [LoginRegisterController::class, 'register'])->name('auth.register');
});

Route::group(['middleware' => ['auth', 'checklevel:admin']], function () {
    // Admin
    Route::get('/admin/home', [LoginRegisterController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/tambah', [AdminController::class, 'tambah'])->name('admin.tambah');
    Route::get('/editAdmin/{id}', [AdminController::class, 'editAdmin'])->name('editAdmin');
    Route::get('/deleteAdmin/{id}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');
    Route::post('/tambahAdmin', [AdminController::class, 'postTambahAdmin'])->name('postTambahAdmin');
    Route::post('/postEditAdmin/{id}', [AdminController::class, 'postEditAdmin'])->name('postEditAdmin');

    // Peminjaman
    Route::get('/admin/peminjaman', [AdminController::class, 'adminPeminjaman'])->name('admin.peminjaman');
    Route::get('/admin/tambahPeminjaman', [AdminController::class, 'tambahPeminjaman'])->name('admin.tambahPeminjaman');
    Route::get('/admin/editPeminjaman/{id}', [AdminController::class, 'editPeminjaman'])->name('admin.editPeminjaman');
    Route::get('/admin/deletePeminjaman/{id}', [AdminController::class, 'deletePeminjaman'])->name('admin.deletePeminjaman');
    Route::get('/admin/detailPeminjaman/{id_peminjaman}/{id_user}/{id_buku}', [AdminController::class, 'detailPeminjaman'])->name('admin.detailPeminjaman');
    Route::get('/admin/cetakPeminjaman', [AdminController::class, 'cetakDataPeminjaman'])->name('admin.cetakDataPeminjaman');

    // Buku
    Route::get('/admin/buku', [AdminController::class, 'adminBuku'])->name('admin.buku');
    Route::get('/admin/tambahBuku', [AdminController::class, 'tambahBuku'])->name('admin.tambahBuku');
    Route::get('/admin/editBuku/{id}', [AdminController::class, 'editBuku'])->name('admin.editBuku');
    Route::get('/admin/deleteBuku/{id}', [AdminController::class, 'deleteBuku'])->name('admin.deleteBuku');
    Route::post('/postTambahBuku', [AdminController::class, 'postTambahBuku'])->name('postTambahBuku');
    Route::post('/postEditBuku/{id}', [AdminController::class, 'postEditBuku'])->name('postEditBuku');
    
    // Berita
    Route::get('/admin/berita', [adminController::class, 'adminBerita'])->name('admin.berita');
    Route::get('/admin/tambahBerita', [AdminController::class, 'tambahBerita'])->name('admin.tambahBerita');
    Route::get('/admin/editBerita/{id}', [AdminController::class, 'editBerita'])->name('admin.editBerita');
    Route::get('/admin/deleteBerita/{id}', [AdminController::class, 'deleteBerita'])->name('admin.deleteBerita');
    Route::post('/postTambahBerita', [AdminController::class, 'postTambahBerita'])->name('postTambahBerita');
    Route::post('/postEditBerita/{id}', [AdminController::class, 'postEditBerita'])->name('postEditBerita');
    
    // Aktivitas
    Route::get('/admin/aktivitas', [adminController::class, 'adminAktivitas'])->name('admin.aktivitas');
    Route::get('/admin/tambahAktivitas', [AdminController::class, 'tambahAktivitas'])->name('admin.tambahAktivitas');
    Route::get('/admin/editAktivitas/{id}', [AdminController::class, 'editAktivitas'])->name('admin.editAktivitas');
    Route::get('/admin/deleteAktivitas/{id}', [AdminController::class, 'deleteAktivitas'])->name('admin.deleteAktivitas');
    Route::post('/postTambahAktivitas', [AdminController::class, 'postTambahAktivitas'])->name('postTambahAktivitas');
    Route::post('/postEditAktivitas/{id}', [AdminController::class, 'postEditAktivitas'])->name('postEditAktivitas');

    // Lulusan
    Route::get('/admin/lulusan', [adminController::class, 'adminLulusan'])->name('admin.lulusan');
    Route::get('/admin/tambahLulusan', [AdminController::class, 'tambahLulusan'])->name('admin.tambahLulusan');
    Route::get('/admin/editLulusan/{id}', [AdminController::class, 'editLulusan'])->name('admin.editLulusan');
    Route::get('/admin/deleteLulusan/{id}', [AdminController::class, 'deleteLulusan'])->name('admin.deleteLulusan');
    Route::post('/postTambahLulusan', [AdminController::class, 'postTambahLulusan'])->name('postTambahLulusan');
    Route::post('/postEditLulusan/{id}', [AdminController::class, 'postEditLulusan'])->name('postEditLulusan');
});

Route::post('/postTambahPeminjaman', [AdminController::class, 'postTambahPeminjaman'])->name('postTambahPeminjaman');
Route::post('/postEditPeminjaman/{id}', [AdminController::class, 'postEditPeminjaman'])->name('postPeminjamanBuku');

Route::group(['middleware' => ['auth', 'checklevel:user']], function () {
    Route::get('/user/home', [LoginRegisterController::class, 'userHome'])->name('user.home');
    Route::get('/user/berita', [LoginRegisterController::class, 'berita'])->name('user.berita');
    Route::get('/profile', [LoginRegisterController::class, 'profile'])->name('profile');
    Route::get('/aktivitas', [LoginRegisterController::class, 'aktivitas'])->name('aktivitas');
});
Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
Route::post('/postLogin', [LoginRegisterController::class, 'postLogin'])->name('postLogin');
Route::post('/postRegister', [LoginRegisterController::class, 'postRegister'])->name('postRegister');

// Route untuk post berita dan lulusan
Route::post('/postBerita', [adminController::class, 'postBerita'])->name('postBerita');
Route::post('postLulusan', [adminController::class, 'postLulusan'])->name('postLulusan');
