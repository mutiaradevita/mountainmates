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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('nama_trip', 255);
            $table->string('lokasi', 255);
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('meeting_point',255);
            $table->text('deskripsi_trip');
            $table->integer('kuota');
            $table->decimal('harga', 10, 2);
            $table->unsignedTinyInteger('dp_persen')->default(30);
            $table->text('paket')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('waktu');
            $table->string('durasi', 255);
            $table->text('sudah_termasuk')->nullable();
            $table->text('belum_termasuk')->nullable();
            $table->text('itinerary')->nullable();
            $table->string('flyer');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
