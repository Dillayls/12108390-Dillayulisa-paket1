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

    public function staff(){
        return view('staff.dashboard-staff');
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

    // tampilan create account staff
    public function createStaff(){
        return view('staff.create-staff');
    }

    public function storeStaff(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'alamat' => 'required|string',
            'role' => 'required|in:admin,staff,peminjam',
        ]);
        User::create([
            'nama' => $validatedData['nama'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'alamat' => $validatedData['alamat'],
            'role' => $validatedData['role'],
        ]);

       return redirect()->route('indexDataStaff');
    }

    public function updateStaff(Request $request, $user_id)
    {
        User::where('user_id', $user_id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'role' => $request->role,
        ]);

       return redirect()->route('indexDataStaff');
    }

    public function editStaff($user_id){
        $data = User::get();
        $data = User::where('id', $user_id)->first();
        return view('staff.edit-staff', ['data' => $data]);
    }

    public function deleteStaff($user_id){
        User::where('id', $user_id)->Delete();
        return redirect(route('indexDataStaff'));
    }

    public function indexDataStaff(){

        $data = User::all();

        return view('staff.data-staff', compact('data'));
    }

}
