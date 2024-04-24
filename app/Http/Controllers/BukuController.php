<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\KategoriController;
use App\Models\Kategori;
use Illuminate\Storage;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Dompdf\Dompdf;

class BukuController extends Controller
{
    private function generatePDF($view, $data, $filename){

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view($view, $data)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($filename);

    }

    public function exportBooksPDF(Request $request)
    {
        $query = Buku::query();

        // Lakukan filter berdasarkan kata kunci pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%')
                  ->orWhere('penerbit', 'like', '%' . $search . '%')
                  ->orWhere('tahun_terbit', 'like', '%' . $search . '%');
            });
        }

        $bukus = $query->get();

        return $this->generatePDF('pdf.buku', compact('bukus'), 'book.pdf');
    }

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
        'kategori_id' => 'required|exists:kategoris,id', // Pastikan kategori_id ada dalam tabel kategoris
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

    public function showBuku(Request $request)
    {

        $query = Buku::latest();

        // Lakukan filter berdasarkan kata kunci pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%')
                  ->orWhere('penerbit', 'like', '%' . $search . '%')
                  ->orWhere('tahun_terbit', 'like', '%' . $search . '%');
            });
        }

        $buku = $query->get();

        return view('buku.buku', compact('buku'));
    }

    public function editBuku($buku_id)
    {
        $kategori = Kategori::all();
        $buku = Buku::get();
        $buku = Buku::where('id', $buku_id)->first();
        return view('buku.edit-buku', (compact('buku', 'kategori')));

    }

    public function updateBuku(Request $request, $buku_id, $buku)
    {
        // Check if a new cover file is uploaded
            if ($request->hasFile('cover')) {
        // Delete old cover file if exists
            FacadesStorage::delete($buku->cover);

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

