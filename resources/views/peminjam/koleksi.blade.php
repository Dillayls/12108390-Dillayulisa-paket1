@extends('peminjam.dashboard-page')

@section('content')
    <div class="container">
        <h2>Koleksi Buku dalam Keranjang</h2><br></br>
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{session ('success')}}
                </div>
            @endif
            @foreach($bukuKeranjangInfo as $buku)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ asset('cover/' . $buku->cover) }}" alt="Card image cap">
                        <div class="card-body">
                            <small class="text-muted text-center d-block">{{$buku->penerbit}} - {{$buku->tahun_terbit}}</small>
                            <hr class="sidebar-divider my-0"><br>
                            <h5 class="card-title text-center">{{ $buku->judul }}</h5>
                            <p class="card-text text-center">{{ $buku->penulis }}</p>
                        </div>
                        <div class="card-footer text-center">
                        <form action="{{ route('removeKeranjang', $buku->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mr-1">Delete</button>
                        </form>
                            
                                @php
                                   $userCollection = auth()->user()->peminjamen;
                               @endphp

                                    @if($userCollection && $userCollection->contains('buku_id', $buku->id))
                                        <button class="btn btn-primary mt-2 btn-sm" disabled>Book Borrowed</button>
                                    @else
                                        <form action="{{ route('borrowBook', ['buku' => $buku->id]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                            <button type="submit" class="btn btn-primary mt-2 btn-sm">Borrow Book</button>
                                        </form>
                                    @endif
                                    
                  
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
