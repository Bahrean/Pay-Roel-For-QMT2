<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use App\Models\Buyer;
use Carbon\Carbon;

class FirebaseSyncService
{
    protected Database $firebase;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(config('firebase.credentials.file'))
            ->withDatabaseUri(config('firebase.database_url'));

        $this->firebase = $factory->createDatabase();
    }

    public function syncBuyers(): int
    {
        $reference = $this->firebase->getReference('users');
        $firebaseBuyers = $reference->getValue();
        
        $syncedCount = 0;

        foreach ($firebaseBuyers as $key => $buyerData) {
            $buyer = Buyer::updateOrCreate(
                ['firebase_key' => $key],
                [
                    'username' => $buyerData['username'] ?? null,
                    'email' => $buyerData['email'] ?? null,
                    'phone' => $buyerData['phone'] ?? null,
                    'address' => $buyerData['address'] ?? null,
                    'last_purchase_at' => isset($buyerData['last_purchase']) 
                        ? Carbon::createFromTimestamp($buyerData['last_purchase']) 
                        : null,
                ]
            );

            if ($buyer->wasRecentlyCreated || $buyer->wasChanged()) {
                $syncedCount++;
            }
        }

        return $syncedCount;
    }
}