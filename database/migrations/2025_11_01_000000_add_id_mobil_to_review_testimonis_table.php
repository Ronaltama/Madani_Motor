<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('review_testimonis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mobil')->nullable()->after('id_review');
            $table->foreign('id_mobil')->references('id_mobil')->on('mobils')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('review_testimonis', function (Blueprint $table) {
            $table->dropForeign(['id_mobil']);
            $table->dropColumn('id_mobil');
        });
    }
};
