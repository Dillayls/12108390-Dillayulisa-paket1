<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBuku()
    {
        $buku = Buku::all();
        return view('peminjam.book-peminjam', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function borrowBook(Request $request, Buku $buku)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        If(auth()->check()){
            Peminjaman::updateOrCreate([
                'user_id' => auth()->id(),
                'buku_id' => $buku->id,
                'tanggal_peminjaman' =>  now(), // asumsikan tanggal peminjam dipinjam hari ini
                'tanggal_pengembalian' => Carbon::now(),
                'status_peminjaman' => 'dipinjam',
            ]);

            // pesan succes
            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        }

        // Redirect ke halam admin jika blm login
        return redirect('/login')->with('accessError', 'Anda harus login terlebih dahulu.');
    }

    public function pengembalian($id)
    {
        // Cari peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Periksa apakah buku sudah dikembalikan sebelumnya
        if ($peminjaman->status_peminjaman == 'dipinjam') {
            // Periksa apakah tanggal pengembalian sudah melewati batas waktu 7 hari
            $batasWaktu = Carbon::parse($peminjaman->tanggal_peminjaman)->addDays(7);

            if (Carbon::now()->gt($batasWaktu)) {
                // Batas waktu pengembalian telah terlampaui
                return redirect()->back()->with('error', 'Maaf, batas waktu pengembalian telah terlampaui.');
            }

            // Ubah status peminjaman menjadi 'sudah dikembalikan'
            $peminjaman->status_peminjaman = 'sudah dikembalikan';

            // Isi tanggal pengembalian dengan tanggal saat ini
            $peminjaman->tanggal_pengembalian = Carbon::now();

            // Simpan perubahan
            $peminjaman->save();

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
        }
    }


    public function showPeminjaman(Peminjaman $peminjaman)
    {
        $peminjaman = Peminjaman::all();
        return view('admin.data-laporan', compact('peminjaman'));
        }

    public function dataPeminjaman(Peminjaman $peminjaman)
    {
        $riwayatPeminjaman = Peminjaman::all();
        return view('peminjam.riwayat-peminjam', compact('riwayatPeminjaman'));
    }

}