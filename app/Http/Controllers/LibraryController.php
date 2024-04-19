<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Collection;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $book = Books::with('category')
            ->when(strlen($search), function ($query) use ($search) {
                return $query->where('title', 'like', "%$search%")
                    ->orWhere('author', 'like', "%$search%")
                    ->orWhere('publisher', 'like', "%$search%")
                    ->orWhere('publication_year', 'like', "%$search%")
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('category', 'like', "%$search%");
                    });
            })
            ->withAvg('review', 'rating')
            ->where('stok', '!=', 0)
            ->orderBy('title')
            ->get();

        return view('dashboard.pustaka.index')
            ->with([
                'title'  => 'Pustaka Buku',
                'active' => 'pustaka',
                'buku'   => $book,
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {
        $book->load(['category', 'review', 'review.user'])
            ->withAvg('review', 'rating');

        $collection = Collection::where('user_id', Auth::user()->id)
            ->where('books_id', $book->id)
            ->exists();

        $review = Review::where('user_id', Auth::user()->id)
            ->where('books_id', $book->id)
            ->exists();

        return view('dashboard.pustaka.show')
            ->with([
                'title'   => $book->title,
                'active'  => 'Pustaka',
                'buku'    => $book,
                'koleksi' => $collection,
                'ulasan'  => $review,
            ]);
    }
}
