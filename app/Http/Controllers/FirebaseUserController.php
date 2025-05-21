<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;

class FirebaseUserController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function index()
    {
        $users = $this->firebaseService->getAllUsers();
        return view('laravel_firebase.firebase.users', compact('users'));
    }

    public function sync()
    {
        try {
            $count = $this->firebaseService->fetchAndStoreUsers();
            return redirect()->route('firebase.users.index')
                ->with('success', "Successfully synced {$count} users from Firebase");
                
        } catch (\Exception $e) {
            return redirect()->route('firebase.users.index')
                ->with('error', "Sync failed: " . $e->getMessage());
        }
    }
}