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
        Schema::table('review_testimonis', function (Blueprint $table) {
            // Drop foreign key dan kolom id_mobil
            $table->dropForeign(['id_mobil']);
            $table->dropColumn('id_mobil');

            // Tambah kolom nama_mobil
            $table->string('nama_mobil')->after('id_review');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('review_testimonis', function (Blueprint $table) {
            // Hapus kolom nama_mobil
            $table->dropColumn('nama_mobil');

            // Tambah kembali kolom id_mobil
            $table->unsignedBigInteger('id_mobil')->nullable()->after('id_review');
            $table->foreign('id_mobil')->references('id_mobil')->on('mobils')->onDelete('cascade');
        });
    }
};
