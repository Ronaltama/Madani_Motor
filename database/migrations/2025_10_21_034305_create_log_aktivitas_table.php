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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')->references('id_admin')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_mobil')->nullable();
            $table->foreign('id_mobil')->references('id_mobil')->on('mobils')->onDelete('set null');
            $table->unsignedBigInteger('id_review')->nullable();
            $table->foreign('id_review')->references('id_review')->on('review_testimonis')->onDelete('set null');
            $table->string('aktivitas');
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
