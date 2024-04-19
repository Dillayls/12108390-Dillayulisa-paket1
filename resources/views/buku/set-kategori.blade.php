@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Set Category</h2>
    <form method="POST" action="{{ route('setKategori', ['id' => $buku->buku_id]) }}">
        @csrf
        <div class="form-group">
    <label for="nama_kategori">Category:</label>
    <select class="form-control" id="nama_kategori" name="nama_kategori">
        @if(isset($kategori))
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
            @endforeach
        @else
            <option value="">No categories found</option>
        @endif
    </select>
</div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('dataBuku') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
