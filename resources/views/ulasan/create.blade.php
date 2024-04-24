
@extends('peminjam.dashboard-page')

@section('content')
    <div class="container">
        <h1>Buat Ulasan Baru</h1>
        <form action="{{ route('ulasan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="buku_id">Pilih Buku:</label>
                <select name="buku_id" id="buku_id" class="form-control">
                    @foreach($buku as $bk)
                        <option value="{{ $bk->id }}">{{ $bk->judul }}</option>
                    @endforeach
                </select>
            </div>

             <div class="form-group">
                <label for="rating">Rating:</label><br>
                <input type="radio" id="satu" name="rating" value="1">
                <label for="satu">1</label>
                <input type="radio" id="dua" name="rating" value="2">
                <label for="dua">2</label>
                <input type="radio" id="tiga" name="rating" value="3">
                <label for="tiga">3</label>
                <input type="radio" id="empat" name="rating" value="4">
                <label for="empat">4</label>
                <input type="radio" id="lima" name="rating" value="5">
                <label for="lima">5</label>
            </div>

            <div class="form-group">
                <label for="ulasan">Ulasan:</label>
                <textarea name="ulasan" id="ulasan" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
@endsection
