<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LogAktivitas;

class CleanupLogAktivitas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:log-aktivitas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup invalid log aktivitas entries (those with null id_review and id_mobil)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cleanup of log aktivitas...');

        // Hapus log yang id_review dan id_mobil keduanya null
        $deleted = LogAktivitas::whereNull('id_review')
                               ->whereNull('id_mobil')
                               ->delete();

        $this->info("Deleted {$deleted} invalid log entries.");
        $this->info('Cleanup completed!');

        return 0;
    }
}
