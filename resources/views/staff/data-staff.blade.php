@extends('layouts.master')
@section('content')


<section class="section">
    <h3 class="section-title pb-2"><a href="{{route('createAccount')}}" title="Tambah Data"
        style="float: right; margin-right: 2%;" class="btn btn-success mr-1">Tambah Data</a></h3>
    <div class="section-header">
        <table id="data-admin" class="table table-striped table-bordered table-md"
            style="width: 100%; margin-top:5%; padding:2%;" cellspacing="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1;?>
                @foreach($data as $dt)

                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$dt->nama}}</td>
                    <td>{{$dt->username}}</td>
                    <td>{{$dt->email}}</td>
                    <td>{{$dt->alamat}}</td>
                    <td>{{$dt->role}}</td>
                    <td>
                        <a href="{{ route('editStaff', ['id' => $dt->id]) }}" class="btn btn-success mr-1">Edit</a>
                        <a href="{{ route('deleteStaff', ['id' => $dt->id]) }}" class="btn btn-danger mr-1">Hapus</i></a>
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
