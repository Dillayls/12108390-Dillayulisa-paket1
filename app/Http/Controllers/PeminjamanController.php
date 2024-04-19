<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function perpusBukuPeminjam()
    {
        $buku = Buku::all();
        $user = User::all();
        $review = Ulasan::all();
        return view('peminjam.book-peminjam', compact('buku', 'user', 'review'));
    }

    public function borrowBook(Request $request, Buku $buku)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
        ]);

        // Ambil tanggal pengembalian dari request
        // $tanggal_pengembalian = Carbon::now()->addDays(7)->toDateString();

        // Tentukan status peminjaman
        // $status_peminjaman = 'belum dikembalikan';


        // Check if user is authenticated
        if (auth()->check()) {
            // Create a new borrowing transaction
            Peminjaman::updateOrCreate([
                'user_id' => auth()->id(),
                'buku_id' => $buku->id,
                'tanggal_peminjaman' => now(), // Assuming borrowing date is the current date
                'tanggal_pengembalian' => Carbon::now(),
                'status_peminjaman' => 'dipinjam',
            ]);

            // Display success message
            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        }

        // Redirect to login page if user is not authenticated
        return redirect('/login')->with('accessError', 'Anda harus login terlebih dahulu.');
    }

//     public function borrowBook(Request $request, Buku $buku)
// {
//     $request->validate([
//         'buku_id' => 'required|exists:bukus,id',
//     ]);

//     // Check if user is authenticated
//     if (auth()->check()) {
//         // Check if the book is already borrowed by the user
//         $existingTransaction = Peminjaman::where('user_id', auth()->id())
//             ->where('buku_id', $buku->id)
//             ->where('status_peminjaman', 'dipinjam')
//             ->first();

//         if ($existingTransaction) {
//             return redirect()->back()->with('error', 'Anda sudah meminjam buku ini.');
//         }

//         // Create a new borrowing transaction
//         Peminjaman::create([
//             'user_id' => auth()->id(),
//             'buku_id' => $buku->id,
//             'tanggal_peminjaman' => now(), // Assuming borrowing date is the current date
//             'tanggal_pengembalian' => Carbon::now()->addDays(7), // Assuming return date is 7 days from now
//             'status_peminjaman' => 'dipinjam',
//         ]);

//         // Display success message
//         return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
//     }

//     // Redirect to login page if user is not authenticated
//     return redirect('/login')->with('accessError', 'Anda harus login terlebih dahulu.');
// }

    public function pengembalian($id)
    {
        // Cari peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        // Periksa apakah buku sudah dikembalikan sebelumnya
        if ($peminjaman->status_peminjaman == 'dipinjam') {
            // Ubah status peminjaman menjadi 'sudah dikembalikan'
            $peminjaman->status_peminjaman = 'sudah dikembalikan';

            // Isi tanggal pengembalian dengan tanggal saat ini
            // $peminjaman->tanggal_pengembalian = now();
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
        // $bukuPeminjaman = Buku::all();
        // $riwayatPeminjaman = auth()->user()->peminjamen;
        // dd($riwayatPeminjaman);

        return view('peminjam.riwayat-peminjam', compact('riwayatPeminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        //
    }


    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
