<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Buku;
use Session;

class UserController extends Controller
{
     // tampilan untuk halamaan layouts
     public function home(){
        return view('layouts.master');
    }

    public function petugas(){
        return view('petugas.dashboard-petugas');
    }

    public function peminjam()
    {
        return view('peminjam.dashboard-page');
    }

    // tampilan dashboard admin
    public function adminPage(){
        $buku = Buku::all();
        return view('admin.admin-page', compact('buku'));
    }

    // tampilan create account petugas
    public function createPetugas(){
        return view('petugas.create-petugas');
    }

    public function storePetugas(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email',
            'nama_lengkap' => 'required|string',
            'alamat' => 'required|string',
            'role' => 'required|in:admin,petugas,peminjam',
        ]);
        User::create([
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'email' => $validatedData['email'],
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'alamat' => $validatedData['alamat'],
            'role' => $validatedData['role'],
        ]);

       return redirect()->route('indexDataPetugas');
    }

    public function updatePetugas(Request $request, $user_id)
    {
        User::where('user_id', $user_id)->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role,
        ]);

       return redirect()->route('indexDataPetugas');
    }

    public function editPetugas($user_id){
        $data = User::get();
        $data = User::where('id', $user_id)->first();
        return view('petugas.edit-petugas', ['data' => $data]);
    }

    public function deletePetugas($user_id){
        User::where('id', $user_id)->Delete();
        return redirect(route('indexDataPetugas'));
    }

    public function indexDataPetugas(){
       
        $data = User::all();

        return view('petugas.data-petugas', compact('data'));
    }
}
