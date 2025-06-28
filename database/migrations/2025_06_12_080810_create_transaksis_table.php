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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('id_trip');
            $table->foreign('id_trip')->references('id')->on('trips')->onDelete('cascade');
            $table->string('nama');
            $table->string('nomor_telepon', 20);
            $table->string('email');
            $table->integer('jumlah_peserta')->default(1);
            $table->string('paket')->nullable(); // masih dipakai
            $table->text('catatan_khusus')->nullable();
            $table->decimal('total', 10, 2)->default(0);
            $table->string('status')->default('menunggu');
            $table->string('payment_order_id')->nullable();
            $table->string('payment_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};