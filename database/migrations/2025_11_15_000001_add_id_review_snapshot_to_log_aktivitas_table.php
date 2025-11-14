<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('log_aktivitas', function (Blueprint $table) {
			$table->unsignedBigInteger('id_review_snapshot')
				->nullable()
				->after('id_review')
				->comment('Original review ID preserved even after deletion');
		});
		// Backfill existing rows where id_review still present (not null)
		DB::statement('UPDATE log_aktivitas SET id_review_snapshot = id_review WHERE id_review IS NOT NULL');
	}

	public function down(): void
	{
		Schema::table('log_aktivitas', function (Blueprint $table) {
			$table->dropColumn('id_review_snapshot');
		});
	}
};