<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Koleksipribadi;
use App\Models\Buku;
use App\Models\User; // Pastikan model User sudah diimport
use App\Http\Controllers\BukuController;

class KoleksipribadiController extends Controller
{
    public function koleksiPeminjam()
    {
        // $bukukeranjang = Buku::all();

        $bukuKeranjang = Koleksipribadi::where('user_id', auth()->id())->pluck('buku_id');

        // Ambil informasi buku berdasarkan id buku yang ada di keranjang
        $bukuKeranjangInfo = Buku::whereIn('id', $bukuKeranjang)->get();
        return view('peminjam.koleksi', compact('bukuKeranjangInfo'));

    }

    public function addKeranjang(Request $request, Buku $buku)
    {
       // Validasi input
       $request->validate([
        'buku_id' => 'required|exists:buku,id',
    ]);

    // Pastikan pengguna telah login
    if (auth()->check()) {
        // Tambahkan buku ke koleksi pribadi pengguna
        Koleksipribadi::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'buku_id' => $request->buku_id,
            ]
        );

        return redirect()->back()->with('sukses', 'Buku berhasil ditambahkan ke koleksi Anda');
    }

    // Jika pengguna tidak login, arahkan ke halaman login
    return redirect('/login')->with('accessError', 'Anda harus login terlebih dahulu.');
}
    public function createKoleksiBuku()
    {
        // Ambil semua buku yang tersedia untuk koleksi
        $buku = Buku::all();

        // Tampilkan formulir untuk membuat koleksi baru
        return view('koleksi.create', compact('buku'));
    }

    public function storeKoleksiBuku(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
        ]);

        // Buat koleksi baru
        Koleksipribadi::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
        ]);

        // Redirect ke halaman yang sesuai
        return redirect()->route('dataKoleksi');
    }

    public function showKoleksi()
    {
        // Ambil semua koleksi pribadi
        $koleksi = Koleksipribadi::all();

        // Tampilkan koleksi pribadi
        return view('peminjam.koleksi', compact('koleksi'));
    }

    // Metode edit, update, dan destroy bisa dikosongkan atau dihapus jika tidak digunakan

    public function removeKeranjang(Buku $buku)
    {
        $user = auth()->user();
        $user->buku()->detach($buku->id);

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari keranjang.');

        // Buku::where('id', $buku_id)->Delete();
        // return redirect()->route('dataBuku');

    }
}

