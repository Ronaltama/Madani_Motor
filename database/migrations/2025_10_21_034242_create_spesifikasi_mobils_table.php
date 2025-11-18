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
        Schema::create('spesifikasi_mobils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mobil');
            $table->foreign('id_mobil')->references('id_mobil')->on('mobils')->onDelete('cascade');
            $table->string('tipe')->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->string('sistem_penggerak')->nullable();
            $table->string('transmisi')->nullable();
            $table->integer('kilometer')->nullable();
            $table->string('plat_asal')->nullable();
            $table->string('nomor_polisi')->nullable();
            $table->string('masa_berlaku')->nullable();
            $table->string('spare_key')->nullable();
            $table->string('toolkit')->nullable();
            $table->string('warna')->nullable();
            $table->unsignedTinyInteger('tangan_ke')->nullable(); // Tangan ke (1,2,3,dst)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesifikasi_mobils');
    }
};
