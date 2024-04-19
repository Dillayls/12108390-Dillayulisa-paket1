@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($ulasanBuku as $ulasanbk)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="{{asset ('cover/' .$ulasanbk->cover)}}" style="width: 100%" alt="">
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $ulasanbk->judul }}</h4>
                                <p class="text-muted">{{ $ulasanbk->penulis }}</p>
                                <p class="text-muted">{{ $ulasanbk->penerbit }} - {{ $ulasanbk->tahun_terbit }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($riwayatUlasan as $ulasan)
                                            @if ($ulasan->buku_id == $ulasanbk->id)
                                                <div class="mb-3">
                                                    <h5>{{ $ulasan->user->username }}</h5>
                                                    <p>{{ $ulasan->ulasan }}</p>
                                                    <div class="rating">
                                                        @for ($i = 0; $i < $ulasan->rating; $i++)
                                                            <i class="mdi mdi-star fs-2" style="color: #fff220;"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
