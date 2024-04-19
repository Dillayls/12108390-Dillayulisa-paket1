@extends('layouts.master')
@section('content')

<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-6">
            <h1 class="mb-0 fw-bold">History</h1>
            <br></br>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col text-end">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Peminjam</th>
                                    <th scope="col">Buku</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Kembali</th>
                                    <th scope="col">Status Peminjaman</th>
                                    <!-- <th scope="col">Actions</th> Tambah kolom untuk tombol aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                @foreach($peminjaman as $peminjaman)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $peminjaman->user->username }}</td>
                                    <td>{{ $peminjaman->buku->judul }}</td>
                                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td>
                                        @if ($peminjaman->status_peminjaman == 'dipinjam')
                                            {{ $peminjaman->tanggal_pengembalian }}
                                        @else
                                            {{ $peminjaman->tanggal_pengembalian }}
                                        @endif
                                    </td>
                                    <td>{{ $peminjaman->status_peminjaman }}</td>
                                    <!-- <td>
                                        @if ($peminjaman->status_peminjaman == 'dipinjam')
                                            <a href="{{ route('pengembalian', ['id' => $peminjaman->id]) }}" class="btn btn-primary">Kembalikan</a>
                                        @else
                                            <button class="btn btn-primary" disabled>Kembalikan</button>
                                        @endif
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
