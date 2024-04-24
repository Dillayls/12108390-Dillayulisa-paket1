@extends('layouts.master')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Create Book Collection </h1>
       <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="/buku">Book Collection</a></div>
        <!-- <div class="breadcrumb-item"><a href="#">Buat data</a></div> -->
      </div>
    </div>

    <div class="section-body">

      <p class="section-lead"></p>
      <br>
      <form method="POST" action="{{route('storeKategori')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                    <h4>Form Kategori Buku</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-sm-12">
                                <label>Kategori</label>
                                <input type="string" class="form-control" name="nama_kategori" >
                            </div>
                        </div>
                        <br>

                        <div class="row align-items-start">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                                <input type="submit" value="Simpan" class="btn btn-block btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
  </section>
@endsection
