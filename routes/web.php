<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KoleksipribadiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\BukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login') ;
Route::post('/loginAuth', [LoginController::class, 'auth'])->name('auth');
Route::get('/register', [LoginController::class, 'regis'])->name('register')  ;
Route::get('/actionregister', [LoginController::class, 'actionregister'])->name('actionregister');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [UserController::class, 'home'])->name('home');
// Route::get('/admin-page',[UserController::class, 'adminPage'])->name('admin-page');
// Route::get('/petugas-page', [UserController::class, 'petugas'])->name('petugas-page');
// Route::get('/peminjam-page', [UserController::class, 'peminjam'])->name('peminjam-page');

// petugas
Route::get('/create-petugas',[UserController::class, 'createPetugas'])->name('createAccount');
Route::post('/store-petugas',[UserController::class, 'storePetugas'])->name('storePetugas');
Route::get('/edit-petugas/{id}',[UserController::class, 'editPetugas'])->name('editPetugas');
Route::post('/update-petugas/{id}',[UserController::class, 'updatePetugas'])->name('updatePetugas');
Route::get('/delete-petugas/{id}',[UserController::class, 'deletePetugas'])->name('deletePetugas');
Route::get('/data-petugas',[UserController::class, 'indexDataPetugas'])->name('indexDataPetugas');

// kategori buku
// Route::get('/kategori-buku',[KategoribukuController::class, 'view'])->name('kategoriBuku');
Route::get('/create-kategori',[KategoriController::class, 'createKategori'])->name('createKategori');
Route::post('/store-kategori',[KategoriController::class, 'storeKategori'])->name('storeKategori');
Route::get('/data-kategori',[KategoriController::class, 'indexDataKategori'])->name('dataKategori');
Route::get('/delete-kategori/{id}',[KategoriController::class, 'deleteKategori'])->name('deleteKategori');

// koleksi
Route::get('/koleksi', [KoleksipribadiController::class, 'showkoleksi'])->name('koleksiPribadi');
Route::get('/create-koleksi',[KoleksipribadiController::class, 'createKoleksiBuku'])->name('createKoleksi');
Route::get('/koleksi-peminjam', [KoleksipribadiController::class, 'koleksiPeminjam'])->name('collection');
Route::post('/addKeranjang', [KoleksipribadiController::class, 'addKeranjang'])->name('addKeranjang');
Route::delete('/removeKeranjang', [KoleksipribadiController::class, 'removeKeranjang'])->name('removeKeranjang');

// peminjaman=
Route::get('/data-peminjaman', [PeminjamanController::class, 'showPeminjaman'])->name('dataPeminjaman');
Route::post('/store-peminjaman', [PeminjamanController::class, 'storePeminjaman'])->name('storePeminjaman');
// Route::get('/peminjam', [PeminjamanController::class, 'peminjam'])->name('peminjam');
Route::get('/perpustakaan-buku', [PeminjamanController::class, 'perpusBukuPeminjam'])->name('libraryBook');
Route::get('/riwayat-peminjam', [PeminjamanController::class, 'dataPeminjaman'])->name('history');
// pinjam buku-------------------
// Route::post('/pinjam-buku/{id}', [PeminjamanController::class, 'pinjamBuku'])->name('pinjamBuku');
Route::post('/borrowBook/{buku}', [PeminjamanController::class, 'borrowBook'])->name('borrowBook');
// Route::get('/pinjam/{id}', [PeminjamanController::class, 'create'])->name('peminjam.create');
// Route untuk menangani pengembalian buku
Route::get('/peminjaman/{id}/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('pengembalian');

// Route::post('/loans/{book}', [LoanController::class, 'store'])->name('loans.store');
// Route::get('/tambah-koleksi/{id}', [KoleksipribadiController::class, 'tambahKoleksi'])->name('addKoleksi');
// Route::post('/review/{id}', [UlasanController::class, 'ulasanBuku'])->name('ulasan');
// Route::post('/addKeranjang', [KoleksipribadiController::class, 'addKeranjang'])->name('addKeranjang');

// buku
Route::get('/buku', [BukuController::class, 'showBuku'])->name('dataBuku');
Route::get('/create-buku', [BukuController::class, 'createBuku'])->name('createBuku');
Route::post('/store-buku', [BukuController::class, 'storeBuku'])->name('storeBuku');
Route::get('/edit-buku/{id}', [BukuController::class, 'editBuku'])->name('editBuku');
Route::post('/update-buku/{id}',[BukuController::class, 'updateBuku'])->name('updateBuku');
Route::get('/delete-buku/{id}',[BukuController::class, 'deleteBuku'])->name('deleteBuku');
// Route::put ('/set-kategori/{id}',[BukuController::class, 'setKategori'])->name('setKategori');

// Ulasan
Route::resource('ulasan', UlasanController::class);
Route::get('/ulasan/create', [UlasanController::class, 'create'])->name('createUlasan');
Route::get('/showUlasan', [UlasanController::class, 'showUlasan'])->name('showUlasan');
// Route::post('/ulasan/store', [UlasanController::class, 'store'])->name('ulasanStore');
// Route::post('/review/update/{id}', [UlasanController::class, 'update'])->name('reviewUpdate');
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
// Route::get('/ulasan/create', [UlasanController::class, 'create'])->name('ulasan.create');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
Route::put('/ulasan/{id}/update', [UlasanController::class, 'update'])->name('reviewUpdate');


Route::middleware('role:admin')->group(function () {
    Route::get('/admin-page',[UserController::class, 'adminPage'])->name('admin-page');
});

Route::middleware('role:petugas')->group(function () {
    Route::get('/petugas-page', [UserController::class, 'petugas'])->name('petugas-page');
});

Route::middleware('role:peminjam')->group(function () {
    Route::get('/peminjam-page',[UserController::class, 'peminjam'])->name('peminjam-page');
});