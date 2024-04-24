<?php

namespace App\Http\Controllers;

use App\Models\Koleksipribadi;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksipribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tampilkan halaman indeks koleksi pribadi jika diperlukan
    }

    public function koleksiPeminjam()
    {
        // Ambil id pengguna yang sedang terautentikasi
        $userId = Auth::id();

        // Ambil daftar id buku dari koleksi pribadi pengguna yang terautentikasi
        $koleksi = Koleksipribadi::where('user_id', $userId)->pluck("buku_id");

        // Ambil informasi buku dari id buku yang terkumpul
        $bukuKeranjang = Buku::whereIn('id', $koleksi)->get();

        // Kembalikan tampilan koleksi dengan buku yang terkumpul
        return view('peminjam.koleksi', compact('bukuKeranjang'));
    }

    public function addKeranjang(Request $request)
    {
        // Validasi input
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        // Pastikan pengguna telah login
        if (Auth::check()) {
            // Tambahkan buku ke koleksi pribadi pengguna
            Koleksipribadi::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'buku_id' => $request->buku_id,
                ]
            );

            return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke koleksi Anda');
        }

        // Jika pengguna tidak login, arahkan ke halaman login
        return redirect('/login')->with('accessError', 'Anda harus login terlebih dahulu.');
    }

    public function removeKeranjang(Buku $buku)
    {
        // Ambil pengguna yang terautentikasi
        $user = Auth::user();

        // Cari entri koleksi pribadi yang sesuai dan hapus
        Koleksipribadi::where('buku_id', $buku->id)->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}
