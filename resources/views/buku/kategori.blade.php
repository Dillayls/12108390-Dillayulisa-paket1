@extends('layouts.master')
@section('content')


<section class="section">
    <div class="section-header">
        <h1>Kategori Buku</h1>

    </div>
    <div class="section-body">

            <a href="{{route('createKategori')}}" title="Tambah Kategori"
                style="float: right; margin-right: 2%" class="btn btn-success mr-1">Tambah Kategori</a><br>
        <table id="data-admin" class="table table-striped table-bordered table-md"
            style="width: 100%; margin-top:5%; padding:2%;" cellspacing="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;?>
                @foreach($kategori as $kt)

                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$kt->nama_kategori}}</td>
                    <td>

                    <a href="{{route('deleteKategori', ['id' => $kt->id]) }}" class="btn btn-danger mr-1">Hapus</i></a>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</section>
<script src="../../assets/admin/dataTables/js/jquery.dataTables.min.js"></script>
<script src="../../assets/admin/dataTables/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#data-admin').DataTable({
            "iDisplayLength": 25
        });
    });

</script>


@endsection
