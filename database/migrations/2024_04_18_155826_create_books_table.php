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
        // Schema::create('category', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('category');
        //     $table->timestamps();
        // });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('cover');
            $table->string('publisher');
            $table->string('publication_year');
            $table->text('description');
            $table->text('gambar')
                ->nullable()
                ->default('/images/buku.png');
            $table->unsignedBigInteger('stok');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
