<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->id(); // BIGINT unsigned auto increment
            $table->foreignId('id_trip')
                  ->constrained('trips')
                  ->onDelete('cascade');
            $table->string('foto', 255);
            $table->text('keterangan')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumentasi');
    }
};
