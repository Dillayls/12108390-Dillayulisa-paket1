<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        $collection = Collection::with(['books', 'books.category'])
            ->where('user_id', $user)
            ->latest()
            ->get();

        // confirmDelete('Hapus Koleksi?', 'Anda yakin ingin hapus Buku dari Koleksi?');

        return view('dashboard.koleksi.index')
            ->with([
                'title' => 'Koleksi Buku Kamu',
                'active' => 'Koleksi',
                'koleksi' => $collection
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'books_id' => 'required',
        ]);

        Collection::create([
            'user_id' => $request->input('user_id'),
            'books_id' => $request->input('books_id'),
        ]);

        // toast('Berhasil ditambahkan ke Koleksi!', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();

        // toast('Berhasil dihapus dari Koleksi.', 'success');

        return redirect()->back();
    }
}
