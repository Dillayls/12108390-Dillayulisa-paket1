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

Route::get('/login', [LoginController::class, 'index'])->name('login') ;
Route::post('/loginAuth', [LoginController::class, 'auth'])->name('auth');
Route::get('/register', [LoginController::class, 'regis'])->name('register')  ;
Route::post('/actionregister', [LoginController::class, 'actionregister'])->name('actionregister');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [UserController::class, 'home'])->name('home');

// staff
Route::get('/create-staff',[UserController::class, 'createStaff'])->name('createAccount');
Route::post('/store-staff',[UserController::class, 'storeStaff'])->name('storeStaff');
Route::get('/edit-staff/{id}',[UserController::class, 'editStaff'])->name('editStaff');
Route::post('/update-staff/{id}',[UserController::class, 'updateStaff'])->name('updateStaff');
Route::get('/delete-staff/{id}',[UserController::class, 'deleteStaff'])->name('deleteStaff');
Route::get('/data-staff',[UserController::class, 'indexDataStaff'])->name('indexDataStaff');

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
Route::delete('/removeKeranjang/{buku}', [KoleksipribadiController::class, 'removeKeranjang'])->name('removeKeranjang');

// peminjaman=
Route::get('/data-peminjaman', [PeminjamanController::class, 'showPeminjaman'])->name('dataPeminjaman');
Route::post('/store-peminjaman', [PeminjamanController::class, 'storePeminjaman'])->name('storePeminjaman');
Route::get('/perpustakaan-buku', [PeminjamanController::class, 'indexBuku'])->name('libraryBook');
Route::get('/riwayat-peminjam', [PeminjamanController::class, 'dataPeminjaman'])->name('history');
// pinjam buku-------------------
Route::post('/borrowBook/{buku}', [PeminjamanController::class, 'borrowBook'])->name('borrowBook');
Route::get('/pengembalian/{id}', [PeminjamanController::class, 'pengembalian'])->name('pengembalian');
Route::get('/peminjaman/export-pdf', [PeminjamanController::class, 'exportToPDF'])->name('peminjaman.export.pdf');



// buku
Route::get('/buku', [BukuController::class, 'showBuku'])->name('dataBuku');
Route::get('/create-buku', [BukuController::class, 'createBuku'])->name('createBuku');
Route::post('/store-buku', [BukuController::class, 'storeBuku'])->name('storeBuku');
Route::get('/edit-buku/{id}', [BukuController::class, 'editBuku'])->name('editBuku');
Route::post('/update-buku/{id}',[BukuController::class, 'updateBuku'])->name('updateBuku');
Route::get('/delete-buku/{id}',[BukuController::class, 'deleteBuku'])->name('deleteBuku');


// Ulasan
Route::resource('ulasan', UlasanController::class);
Route::get('/ulasan/create', [UlasanController::class, 'create'])->name('createUlasan');
Route::get('/showUlasan', [UlasanController::class, 'showUlasan'])->name('showUlasan');
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
// Route::get('/ulasan/create', [UlasanController::class, 'create'])->name('ulasan.create');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
Route::put('/ulasan/{id}/update', [UlasanController::class, 'update'])->name('reviewUpdate');
Route::get('/export-books-pdf', [BukuController::class, 'exportBooksPDF'])->name('exportBooksPDF');

Route::middleware('role:admin')->group(function () {
    Route::get('/admin-page',[UserController::class, 'adminPage'])->name('admin-page');
});

Route::middleware('role:staff')->group(function () {
    Route::get('/staff-page', [UserController::class, 'staff'])->name('staff-dashboard');
});

Route::middleware('role:peminjam')->group(function () {
    Route::get('/peminjam-page',[UserController::class, 'peminjam'])->name('peminjam-page');
});
