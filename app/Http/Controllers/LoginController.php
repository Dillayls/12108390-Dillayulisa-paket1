<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    public function index() {
        return view('login.login');
    }

    public function auth(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($login)) {
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin') {
                return redirect()->intended('/admin-page');
            } elseif (Auth::user()->role == 'petugas') {
                return redirect()->intended('/petugas-page');
            } elseif (Auth::user()->role == 'peminjam') {
                return redirect()->intended('/peminjam-page');
            }
        }
        return back()->with('loginError', 'Login error! Email atau Password salah');
    }

    public function regis(){
        return view('login.register');
    }

    // data untuk regsiter
    public function actionregister(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role,
        ]);

        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        return redirect()->route('login');
    }

     // logout
     public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
