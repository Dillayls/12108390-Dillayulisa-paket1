<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::withCount('books')
            ->orderBy('Category')
            ->get();

        // confirmDelete('Hapus Kategori Buku?', 'Anda yakin ingin hapus Kategori Buku?');

        return view('dashboard.kategori.index')
            ->with([
                'title'    => 'Kategori Buku',
                'active'   => 'Kategori',
                'kategori' => $category,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_category' => ['required', 'string', 'max:255', 'unique:category,category']
        ]);

        try {
            Category::create([
                'category' => $request->input('nama_category'),
            ]);

            // toast('Kategori Buku berhasil dibuat!', 'success');
        } catch (\Exception $e) {
            // toast('Kategori Buku gagal dibuat.', 'warning');
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategori,kategori,' . $category->id]
        ]);

        try {
            $category->update([
                'kategori' => $request->input('nama_category'),
            ]);

            // toast('Kategori Buku berhasil diedit!', 'success');
        } catch (\Exception $e) {
            // toast('Kategori Buku gagal diedit.', 'warning');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        // toast('Kategori Buku berhasil dihapus.', 'success');

        return redirect()->back();
    }
}
