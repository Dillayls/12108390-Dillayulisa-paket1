<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('alamat');
            // $table->unsignedBigInteger('role_id');
            $table->enum('role', ['admin', 'staff', 'peminjam']);
            $table->rememberToken();
            $table->timestamps();

            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('users', function (Blueprint $table) {
        //     // Menghapus foreign key constraint sebelum menghapus tabel users
        //     $table->dropForeign(['role_id']);
        // });

        Schema::dropIfExists('users');
    }
};
