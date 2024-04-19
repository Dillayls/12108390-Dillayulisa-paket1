<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'nama_lengkap' => 'Admin Perpustakaan',
            'alamat' => 'Bogor, Jawa Bart',
            'role' => 'admin',
        ]);

        // User::create([
        //     'username' => 'petugas',
        //     'email' => 'petugas@gmail.com',
        //     'password' => 'petugas123',
        //     'nama_lengkap' => 'Petugas Perpustakaan',
        //     'alamat' => 'Bogor, Jawa Bart',
        //     'role' => 'petugas',
        // ]);

        // User::create([
        //     'username' => 'peminjam',
        //     'email' => 'peminjam@gmail.com',
        //     'password' => 'peminjam123',
        //     'nama_lengkap' => 'Peminjam Perpustakaan',
        //     'alamat' => 'Bogor, Jawa Bart',
        //     'role' => 'peminjam',
        // ]);
    }
}
