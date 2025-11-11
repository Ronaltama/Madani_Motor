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
Schema::create('review_testimonis', function (Blueprint $table) {
    $table->id('id_review');
    $table->unsignedBigInteger('id_mobil')->nullable();
    $table->string('nama_pelanggan');
    $table->date('tanggal')->nullable();
    $table->text('isi_review');
    $table->integer('rating')->default(0);
    $table->string('foto_url')->nullable();
    $table->timestamps();

    $table->foreign('id_mobil')->references('id_mobil')->on('mobils')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_testimonis');
    }
};
