<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->input('user');
        $ulasan = Ulasan::all();
        return view('ulasan.create', compact('user', 'ulasan'));
    }

    public function create()
    {
        $buku = Buku::all();
        return view('ulasan.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $ulasan = new Ulasan();
        $ulasan->user_id = Auth::id();
        $ulasan->buku_id = $request->buku_id;
        $ulasan->rating = $request->rating;
        $ulasan->ulasan = $request->ulasan;
        $ulasan->save();

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan.');
    }

    public function show(Ulasan $ulasan)
    {
        $ulasan->load(['user', 'buku']);
        return view('ulasan.admin.show')
            ->with([
                'title'  => 'Detail Ulasan',
                'active' => 'Ulasan',
                'ulasan' => $ulasan,
            ]);
    }

    public function showUlasan(Ulasan $riwayatUlasan)
    {
        $riwayatUlasan = Ulasan::all();
        $ulasanBuku = Buku::all();
        $dtUlasan = User::all();
        return view('ulasan.index', compact('riwayatUlasan', 'ulasanBuku', 'dtUlasan'));
    }

    public function edit(Ulasan $ulasan)
    {
        $ulasan->load('buku');
        if (auth()->id() !== $ulasan->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }
        return view('ulasan.edit', compact('ulasan'));
    }

    public function update(Request $request, Ulasan $ulasan)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string',
        ]);

        if (auth()->id() !== $ulasan->user_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit ulasan ini.');
        }

        $ulasan->update([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
