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
            $table->string('nama_trip',50);
            $table->string('deskripsi_trip',100);
            $table->enum('tipe_trip', ['open', 'private'])->default('open');
            $table->date('tanggal_trip');
            $table->string('flyer');
            $table->text('jadwal_trip')->nullable();
            $table->text('itinerary')->nullable();
            $table->time('waktu')->default('00:00');
            $table->string('lokasi',100);
            $table->string('status', 20); 
            $table->integer('kuota')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
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