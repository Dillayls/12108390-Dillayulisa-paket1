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
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });


        // Schema::table('bukus', function (Blueprint $table){
        //     $table->unsignedBigInteger('kategori_id');
        //     $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('bukus', function(Blueprint $table) {
        //     $table->dropForeign(['kategori_id']);
        //     $table->dropColumn('kategori_id');
        // });

        Schema::dropIfExists('kategori');
    }
};
