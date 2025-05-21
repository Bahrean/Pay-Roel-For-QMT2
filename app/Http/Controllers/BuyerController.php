<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Services\FirebaseSyncService;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::orderBy('last_purchase_at', 'desc')->paginate(15);
        return view('buyers.index', compact('buyers'));
    }

    public function sync(FirebaseSyncService $syncService)
    {
        try {
            $count = $syncService->syncBuyers();
            return back()->with('success', "Successfully synced {$count} buyers.");
        } catch (\Exception $e) {
            return back()->with('error', "Sync failed: " . $e->getMessage());
        }
    }
}