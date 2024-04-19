@extends('login.index')
@section('container')
        <div class="row justify-content-center">
            <div class="col-lg-5">
                {{-- Jika kita berhasil melakukan registrasi alert ini akan muncul , alert ini diatur didalam RegisterController --}}
                @if (session('loginError'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session ('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="container">
                    <main class="form-register">
                        <form action="{{route('actionregister')}}" method="POST">
                           @csrf
                            <h1 class="h3 mb-3 fw-normal">Register</h1>

                            <div class="form-floating">
                                <input type="string" name="username" class="form-control mt-2" id="username" placeholder="siti">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control mt-2" id="password" placeholder="Password">
                                <label for="password">Password</label>
                            </div>
                            
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control mt-2" id="email" placeholder="name@example.com">
                                <label for="email">Email</label>
                            </div>
                            
                            <div class="form-floating">
                                <input type="nama_lengkap" name="nama_lengkap" class="form-control mt-2" id="nama_lengkap" placeholder="name@example.com">
                                <label for="nama_lengkap">Nama Lengkap</label>
                            </div>
                            
                            <div class="form-floating">
                                <input type="alamat" name="alamat" class="form-control mt-2" id="alamat" placeholder="Jl. Raya Bogor">
                                <label for="alamat">Alamat</label>
                            </div>

                             <!-- Dropdown untuk memilih peran -->
                        <!-- <div class="form-floating mt-2">
                            <select class="form-select" id="role" name="role" required>
                                <option value="petugas">Petugas</option>
                                <option value="peminjam">Peminjam</option>
                            </select>
                            <label for="role">Role</label>
                        </div> -->

                            <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Register</button>
                            
                        </form>
                        <small class="d-block text-center mt-3">Sudah punya akun? <a href="/login">Login</a></small>
                    </main>
                </div>
            </div>
        </div>
@endsection