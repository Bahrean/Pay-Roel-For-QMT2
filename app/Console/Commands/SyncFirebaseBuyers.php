<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FirebaseSyncService;

class SyncFirebaseBuyers extends Command
{
    protected $signature = 'firebase:sync-buyers';
    protected $description = 'Sync buyers from Firebase Realtime Database to MySQL';

    public function handle(FirebaseSyncService $syncService)
    {
        $this->info('Starting Firebase buyers sync...');
        
        try {
            $count = $syncService->syncBuyers();
            $this->info("Successfully synced {$count} buyers.");
            return 0;
        } catch (\Exception $e) {
            $this->error("Sync failed: " . $e->getMessage());
            return 1;
        }
    }
}