<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Session;
use App\Models\User;

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
            } elseif (Auth::user()->role == 'staff') {
                return redirect()->intended('/staff-page');
            } elseif (Auth::user()->role == 'peminjam') {
                return redirect()->intended('/perpustakaan-buku');
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
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'role' => $request->role,
        ]);

        return redirect()->route('login')->with('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');;
    }

     // logout
     public function logout(Request $request){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}

