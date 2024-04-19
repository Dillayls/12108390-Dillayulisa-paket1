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
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->text('review');
            $table->enum('rating', [1, 2, 3, 4, 5]);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('books_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('books_id')
                ->references('id')
                ->on('books');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};