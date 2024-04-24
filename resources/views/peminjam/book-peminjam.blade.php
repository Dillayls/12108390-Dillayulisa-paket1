@extends('peminjam.dashboard-page')


@section('content')
   <!-- Content Row -->
   @if(session('sukses'))
        <div class="alert alert-success">
            {{ session('sukses') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
   <div class="row">
       <div class="col-lg-12 mb-4">
           <div class="card-deck">
               <!-- BUKU -->
               @foreach($buku as $bk)
               <div class="col-md-3 mb-4">
                   <div class="card">
                       <img src="{{ asset('cover/' . $bk->cover) }}" />


                       <div class="card-body">
                           <small class="text-muted text-center d-block">{{$bk->penerbit}} - {{$bk->tahun_terbit}}</small>
                           <hr class="sidebar-divider my-0"> <br>
                           <h5 class="card-title text-center">{{$bk->judul}}</h5>
                           <p class="card-text text-center">{{$bk->penulis}}</p>
                           <a class="nav-link text-center" href="/showUlasan"><span>See Review</span></a>
                       </div>
                       <div class="card-footer">
                           <div class="text-center">

                            <!-- @if(auth()->check())
                                @php
                                   $userCollection = auth()->user()->peminjamen;
                                @endphp
                                @if($userCollection && $userCollection->contains('buku_id', $bk->id))
                                    @if($userCollection->where('buku_id', $bk->id)->first()->status_peminjaman == 'dipinjam')
                                        <button class="btn btn-primary mt-2 btn-sm" disabled>Book Borrowed</button>
                                    @else
                                        <button class="btn btn-primary mt-2 btn-sm" >Borrow Book</button>
                                    @endif
                                @else
                                    <form action="{{ route('borrowBook', ['buku' => $bk->id]) }}" method="post">
                                    @csrf
                                        <input type="hidden" name="buku_id" value="{{ $bk->id }}">
                                        <button type="submit" class="btn btn-primary mt-2 btn-sm">Borrow Book</button>
                                    </form>
                                @endif
                            @endif -->

                            @if(auth()->check())
                            @php
                                $userCollection = auth()->user()->peminjamen;
                                $userBorrowedBooks = auth()->user()->peminjamen->pluck('buku_id')->toArray();
                            @endphp
                            @if($userCollection && $userCollection->contains('buku_id', $bk->id))
                            @if($userCollection->where('buku_id', $bk->id)->first()->status_peminjaman == 'dipinjam')
                                <!-- Check if the book is borrowed by the user -->
                                <button class="btn btn-primary mt-2 btn-sm" disabled>Buku Dipinjam</button>
                            @else
                                <!-- Check if the book is returned by the user -->
                                @if(in_array($bk->id, $userBorrowedBooks))
                            <form action="{{ route('borrowBook', ['buku' => $bk->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $bk->id }}">
                    <button type="submit" class="btn btn-primary mt-2 btn-sm">Pinjam Buku</button>
                </form>
            @else
                <button class="btn btn-primary mt-2 btn-sm" disabled>Buku dipinjam</button>
            @endif
        @endif
    @else
        <form action="{{ route('borrowBook', ['buku' => $bk->id]) }}" method="post">
            @csrf
            <input type="hidden" name="buku_id" value="{{ $bk->id }}">
            <button type="submit" class="btn btn-primary mt-2 btn-sm">Pinjam Buku</button>
        </form>
    @endif
@endif




                                @if(auth()->check())
                                    @php
                                       $userCollection = auth()->user()->koleksipribadis;
                                    @endphp
                                    @if($userCollection && $userCollection->contains('buku_id', $bk->id))
                                        <button class="btn btn-success mt-2 btn-sm" disabled>Buku berada di koleksi anda</button>
                                    @else
                                        <form action="{{ route('addKeranjang', ['buku' => $bk->id]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="buku_id" value="{{ $bk->id }}">
                                            <button type="submit" class="btn btn-success mt-2 btn-sm">Tambah ke koleksi</button>
                                        </form>
                                    @endif
                                @endif



                                @if(auth()->check())
                                @php
                                   $userBorrowedBooks = auth()->user()->peminjamen->pluck('buku_id')->toArray();
                                @endphp
                                @if(in_array($bk->id, $userBorrowedBooks))
                                    <!-- Check if the user has already reviewed the book -->
                                    @if(isset($userReview[$bk->id]) && $userReview[$bk->id])
                                        <a href="{{ route('editReviewForm', ['id' => $bk->id]) }}" class="btn btn-warning mt-2 btn-sm">Edit Ulasan</a>
                                    @else
                                        <a href="{{ route('createUlasan', ['id' => $bk->id]) }}" class="btn btn-info mt-2 btn-sm">Ulasan</a>
                                    @endif
                                @endif
                            @endif


                           </div>
                       </div>
                   </div>
               </div>
               @endforeach
           </div>
       </div>
   </div>
@endsection
