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
            $table->string('paket')->nullable(); 
            $table->text('catatan_khusus')->nullable();
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('total_dp', 10, 2);
            $table->decimal('total_keseluruhan', 10, 2)->default(0);
            $table->enum('status', ['menunggu', 'berlangsung', 'selesai', 'batal'])->default('menunggu');
            $table->enum('status_pembayaran', ['menunggu dp', 'dp', 'lunas', 'gagal', 'batal'])->default('menunggu dp');
            $table->string('payment_order_id')->nullable();
            $table->string('pelunasan_order_id')->nullable();
            $table->string('payment_token')->nullable();
            $table->string('pelunasan_token')->nullable();
            $table->decimal('total_pelunasan', 10, 2)->nullable();
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