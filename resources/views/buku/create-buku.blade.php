@extends('layouts.master')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Create Add Buku</h1>
    <!-- <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Buat Accountn</a></div>
      </div> -->
  </div>

  <div class="section-body">
    <!-- <h2 class="section-title">Buat Account</h2> -->
    <p class="section-lead"></p>
    <br>
    <form method="POST" action="{{route('storeBuku')}}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              <h4>Form Add Buku</h4>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="judul">
                </div>
              </div>
              <div class="form-group row">
                <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="penulis">
                </div>
              </div>
              <div class="form-group row">
                <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="penerbit">
                </div>
              </div>
              <div class="form-group row">
                <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                <div class="col-sm-5">
                  <input type="number" class="form-control" name="tahun_terbit">
                </div>
              </div>
              <div class="form-group row">
                <label for="kategori_id" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-5">
                  <select name="kategori_id" class="form-control">
                    @foreach($kategori as $kat)
                    <option value="{{ $kat->id}}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="cover" class="col-sm-3 col-form-label">Cover</label>
                <div class="col-sm-5">
                  <input type="file" class="form-control" name="cover">
                </div>
              </div>
              <!-- <input type="hidden" name="is_admin" value="0">
            </div> -->
            <!-- <div class="card-footer text-right"> -->
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</section>
@endsection
