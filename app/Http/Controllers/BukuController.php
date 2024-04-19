<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\KategoriController;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function createBuku()
    {
        $kategori = Kategori::all();
        // $buku = Buku::all();
        return view('buku.create-buku', compact('kategori'));
        // return view('buku.create-buku');
    }

    public function storeBuku(Request $request)
    {
        // Validasi input
        $request->validate([
        'judul' => 'required|string',
        'penulis' => 'required|string',
        'penerbit' => 'required|string',
        'tahun_terbit' => 'required|integer',
        'kategori_id' => 'required|exists:kategori,id', // Pastikan kategori_id ada dalam tabel kategoris
        'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cover = $request->file('cover');

        $imgName = time().rand().'.'.$cover->extension();
        if(!file_exists(public_path('/cover'.$cover->getClientOriginalName()))){
            $destinationPath =  public_path('/cover');
            $cover->move($destinationPath, $imgName);
            $uploaded = $imgName;
        }else {
            $uploaded = $cover->getClientOriginalName();
        }

        $kategori_id = $request->kategori_id ?? null;

        if ($request->has('kategori_id')) {
            $kategori_id = $request->kategori_id;
        } else {
            // Jika 'kategori_id' tidak disertakan, Anda dapat menetapkan nilai default atau menangani kasus ini sesuai kebutuhan Anda
            $kategori_id = null; // Atau nilai default lainnya
        }

        Buku::create([
            'judul' => $request->judul,
            'penulis'=>$request->penulis,
            'penerbit'=>$request->penerbit,
            'tahun_terbit'=>$request->tahun_terbit,
            'kategori_id' => $request->kategori_id,
            'cover'=>$uploaded,

        ]);

        return redirect()->route('dataBuku');
    }

    public function showBuku(Buku $buku)
    {
        $buku = Buku::with('kategori')->get();
        // $kategori = Kategoribuku::all();
        return view('buku.buku', compact('buku'));
    }

    public function editBuku($buku_id)
    {
        $kategori = Kategori::all();
        $buku = Buku::get();
        $buku = Buku::where('id', $buku_id)->first();
        return view('buku.edit-buku', (compact('buku', 'kategori')));

    }

    public function updateBuku(Request $request, $buku_id)
    {
        // Check if a new cover file is uploaded
            if ($request->hasFile('cover')) {
        // Delete old cover file if exists
            Storage::delete($buku->cover);

        // Upload new cover file
            $coverPath = $request->file('cover')->store('covers');

        // Update cover field in database
            $buku->cover = $coverPath;
        }
        Buku::where('id', $buku_id)->update([
            'judul' => $request->judul,
            'penulis'=>$request->penulis,
            'penerbit'=>$request->penerbit,
            'tahun_terbit'=>$request->tahun_terbit,
            // 'cover'=>$uploaded,
            'kategori_id' => $request->kategori_id,
        ]);
        return redirect()->route('dataBuku');
    }

    public function deleteBuku($buku_id)
    {
        Buku::where('id', $buku_id)->Delete();
        return redirect()->route('dataBuku');
    }
}

