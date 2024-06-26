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
        Schema::create('koleksipribadis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('buku_id');
            $table->timestamps();


        // Schema::table('koleksipribadis', function (Blueprint $table) {
            // Menambahkan foreign key constraint untuk user_id
            $table->foreign('user_id')->references('id')->on('users');

            // Menambahkan foreign key constraint untuk buku_id
            $table->foreign('buku_id')->references('id')->on('bukus');
        // });
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koleksipribadis');
    }
};
