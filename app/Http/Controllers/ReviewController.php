<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        $review = Review::with(['user', 'books'])
            ->when(strlen($user), function ($query) use ($user) {
                return $query->where('user_id', $user);
            })
            ->latest()
            ->get();

        strlen($user) ? $title = 'Ulasan Kamu' : $title = 'Ulasan Buku';
        strlen($user) ? $view = 'dashboard.ulasan.index' : $view = 'dashboard.ulasan.admin.index';

        // confirmDelete('Hapus Ulasan?', 'Anda yakin ingin hapus Ulasan?');

        return view($view)
            ->with([
                'title'  => $title,
                'active' => 'Ulasan',
                'ulasan' => $review,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'review'       => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['user', 'buku']);

        // confirmDelete('Hapus Ulasan?', 'Anda yakin ingin hapus Ulasan?');

        return view('dashboard.ulasan.admin.show')
            ->with([
                'title'  => 'Detail Ulasan',
                'active' => 'Ulasan',
                'ulasan' => $review,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        // toast('Ulasan berhasil dihapus.', 'success');

        return redirect()->back();
    }
}
