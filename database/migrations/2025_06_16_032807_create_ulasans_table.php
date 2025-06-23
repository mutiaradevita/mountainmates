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
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_transaksi')->references('id')->on('transaksis')->onDelete('cascade');
            $table->foreignId('id_transaksi')->constrained('transaksis')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreign('id_trip')->references('id')->on('trips')->onDelete('cascade');
            $table->foreignId('id_trip')->constrained('trips')->onDelete('cascade');
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
