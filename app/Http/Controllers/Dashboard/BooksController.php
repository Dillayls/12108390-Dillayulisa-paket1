<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Books::with('category')
            ->orderBy('title')
            ->get();

        // confirmDelete('Hapus Buku?', 'Anda yakin ingin hapus Buku dari Koleksi Buku?');

        return view('dashboard.buku.index')
            ->with([
                'title'  => 'Koleksi Buku',
                'active' => 'Buku',
                'buku'   => $book,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::orderBy('category', 'asc')
            ->get();

        return view('')
            ->with([
                'title'    => 'Tambah Koleksi Buku',
                'active'   => 'Buku',
                'category' => $category,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => ['required', 'string', 'max:255', 'unique:books,title'],
            'author'      => ['required', 'string', 'max:255'],
            'publisher'     => ['required', 'string', 'max:255'],
            'publication_year' => ['required', 'numeric'],
            'stok'         => ['required', 'numeric'],
            'category'     => ['required'],
            'description'    => ['required'],
        ]);

        $book = [
            'title'        => $judul = $request->input('title'),
            'author'      => $request->input('author'),
            'publisher'     => $request->input('publisher'),
            'publication_year' => $request->input('publication_year'),
            'stok'         => $request->input('stok'),
            'category_id'  => $request->input('category'),
            'description'    => $request->input('description'),
        ];

        // if ($request->hasFile('cover')) {
        //     $request->validate([
        //         'cover' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp']
        //     ]);

        //     $file = $request->file('cover');
        //     $file->move(public_path('storage/book'), $gambar);

        //     $book['gambar'] = '/storage/book/' . $gambar;
        // }

        // try {
        //     Books::create($book);

        //     // toast('Buku berhasil ditambahkan!', 'success');

        //     return redirect()->route('');
        // } catch (\Exception $e) {
        //     toast('Buku gagal ditambahkan.', 'warning');

        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {
        // confirmDelete('Hapus Buku?', 'Anda yakin ingin hapus Buku dari Koleksi Buku?');

        return view('dashboard.buku.show')
            ->with([
                'title'  => 'Detail Buku',
                'active' => 'Buku',
                'buku'   => $book,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $book)
    {
        $category = Category::orderBy('category', 'asc')
            ->get();

        return view('dashboard.buku.edit')
            ->with([
                'title'    => 'Edit Buku',
                'active'   => 'Buku',
                'category' => $category,
                'buku'     => $book,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $book)
    {
        $request->validate([
            'title'        => ['required', 'string', 'max:255', 'unique:book,title,' . $book->id],
            'author'      => ['required', 'string', 'max:255'],
            'publisher'     => ['required', 'string', 'max:255'],
            'publication_year' => ['required', 'numeric'],
            'stok'         => ['required', 'numeric'],
            'category'     => ['required'],
            'description'    => ['required'],
        ]);

        $updatedBook = [
            'title'        => $title = $request->input('title'),
            'author'      => $request->input('author'),
            'publisher'     => $request->input('publisher'),
            'publication_year' => $request->input('publication_year'),
            'stok'         => $request->input('stok'),
            'category_id'  => $request->input('category'),
            'description'    => $request->input('description'),
        ];

        // if ($request->hasFile('cover')) {
        //     $request->validate([
        //         'cover' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp']
        //     ]);

        //     $file = $request->file('cover');

        //     if ($book->gambar !== '/images/book.png') {
        //         File::delete(public_path($book->gambar));
        //     }

        //     $file->move(public_path('storage/buku'), $gambar);
        //     $updatedBook['gambar'] = '/storage/buku/' . $gambar;
        // }

        // try {
        //     $book->update($updatedBook);

        //     toast('Buku berhasil diedit!', 'success');

        //     return redirect()->route('buku.index');
        // } catch (\Exception $e) {
        //     toast('Buku gagal diedit.', 'warning');

        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        if ($book->gambar !== '/images/buku.png') {
            File::delete(public_path($book->gambar));
        }

        $book->delete();

        // toast('Buku berhasil dihapus dari Koleksi Buku.', 'success');

        return redirect()->back();
    }
}
