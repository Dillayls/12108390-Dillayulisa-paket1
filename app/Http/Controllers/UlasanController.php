<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $user = $request->input('user');
        $ulasan = Ulasan::all();
        return view('ulasan.create', compact('user', 'ulasan'));

        // $semuaUlasan = Ulasan::with(['user', 'buku'])
        //     ->when(strlen($user), function ($query) use ($user) {
        //         return $query->where('user_id', $user, compact('semuaUlasan', 'ulasan'));
        //     })
        //     ->latest()
        //     ->get();

        strlen($user) ? $title = 'Ulasan Kamu' : $title = 'Ulasan Buku';
        strlen($user) ? $view = 'ulasan.create' : $view = 'ulasan.create';
        // strlen($user) ? $view = 'peminjam.book-peminjam' : $view = 'peminjam.book-peminjam';

        confirmDelete('Hapus Ulasan?', 'Anda yakin ingin hapus Ulasan?');

        return view($view)
            ->with([
                'title'  => $title,
                'active' => 'Ulasan',
                'semuaUlasan' => $semuaUlasan, // Definisikan variabel $semuaUlasan di sini
            ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua buku yang bisa diulas
        $buku = Buku::all();

        return view('ulasan.create', compact('buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
            'buku_id' => 'required|exists:buku,id',
        ]);

        // Create a new ulasan instance
        $ulasan = new Ulasan();
        $ulasan->user_id = Auth::id(); // Set the user_id to the current authenticated user's id
        $ulasan->buku_id = $request->buku_id;
        $ulasan->rating = $request->rating;
        $ulasan->ulasan = $request->ulasan;
        $ulasan->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ulasan $ulasan)
    {
        $ulasan->load(['user', 'buku']);

        confirmDelete('Hapus Ulasan?', 'Anda yakin ingin hapus Ulasan?');

        return view('ulasan.admin.show')
            ->with([
                'title'  => 'Detail Ulasan',
                'active' => 'Ulasan',
                'ulasan' => $ulasan,
            ]);
    }

    public function showUlasan(Ulasan $riwayatUlasan) {
        $riwayatUlasan = Ulasan::all();
        $ulasanBuku = Buku::all();
        $dtUlasan = User::all();
        return view('ulasan.index', compact('riwayatUlasan', 'ulasanBuku', 'dtUlasan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ulasan $ulasan)
    {
        // Load the ulasan's related buku
        $ulasan->load('buku');

        // Check if the authenticated user owns the ulasan
        if (auth()->id() !== $ulasan->user_id) {
            // Jika bukan pemilik ulasan, arahkan pengguna kembali dan tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }

        // Tampilkan formulir pengeditan ulasan
        return view('ulasan.edit', compact('ulasan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ulasan $ulasan)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
        ]);

        // Check if the authenticated user owns the ulasan
        if (auth()->id() !== $ulasan->user_id) {
            // Jika bukan pemilik ulasan, arahkan pengguna kembali dan tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }

        // Perbarui ulasan dengan data yang diterima dari formulir
        $ulasan->update([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        // Redirect pengguna ke halaman yang sesuai setelah pembaruan berhasil
        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();

        toast('Ulasan berhasil dihapus.', 'success');

        return redirect()->back();
    }
}
