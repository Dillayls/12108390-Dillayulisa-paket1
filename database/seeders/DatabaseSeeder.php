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

        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'alamat' => 'Bogor, Jawa Bart',
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Staff',
            'username' => 'staffperpus',
            'email' => 'staff@gmail.com',
            'password' => 'staff123',
            'alamat' => 'Bogor',
            'role' => 'staff',
        ]);

        // User::create([
        //     'nama' => 'Peminjam Perpustakaan',
        //     'username' => 'peminjamperpus',
        //     'email' => 'peminjam@gmail.com',
        //     'password' => 'peminjam123',
        //     'alamat' => 'Bogor',
        //     'role' => 'peminjam',
        // ]);
    }
}
