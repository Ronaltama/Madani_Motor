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
        Schema::create('foto_mobils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mobil');
            $table->foreign('id_mobil')->references('id_mobil')->on('mobils')->onDelete('cascade');
            $table->string('full_body')->nullable();
            $table->string('foto_depan')->nullable();
            $table->string('foto_belakang')->nullable();
            $table->string('foto_kiri')->nullable();
            $table->string('foto_kanan')->nullable();
            $table->string('tambahan1')->nullable();
            $table->string('tambahan2')->nullable();
            $table->string('tambahan3')->nullable();
            $table->string('tambahan4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_mobils');
    }
};
