@extends('layouts.master')
@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="section-title">BOOK Collection
            <a href="{{ route('createBuku') }}" title="Tambah Data" style="float: right; margin-right: 2%"
                class="btn btn-primary mr-1">Tambah Buku</a>
        </h3>
        <table id="data-admin" class="table table-striped table-bordered table-md" style="width: 100%; margin-top:5%; padding:2%;" cellspacing="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Category</th>
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($buku as $bk)
                <tr>
                    <td>{{$i++}}</td>
                    <td style="width: 100px;"><img src="{{ asset('cover/'.$bk->cover) }}" class="img-fluid" alt="" style="width: 100%;"></td>
                    <td>{{$bk->judul}}</td>
                    <td>{{$bk->penulis}}</td>
                    <td>{{$bk->tahun_terbit}}</td>
                    <td>
                        {{$bk->kategori->nama_kategori}}
                    </td>
                    <td>
                        <a href="{{ route('editBuku', ['id' => $bk->id]) }}" class="btn btn-primary mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('deleteBuku', ['id' => $bk->id]) }}" class="btn btn-danger mr-1">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<script src="{{ asset('assets/admin/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/dataTables/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#data-admin').DataTable({
            "iDisplayLength": 25
        });
    });

</script>

@endsection
