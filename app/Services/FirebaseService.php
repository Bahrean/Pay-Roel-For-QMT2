<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\AuthException;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\FirebaseUser;

class FirebaseService
{
    protected $database;
    protected $auth;
    protected $initialized = false;

    public function __construct()
    {
        $this->initializeServices();
    }

    protected function initializeServices(): void
    {
        if ($this->initialized) {
            return;
        }

        try {
            $credentialsPath = config('firebase.credentials_path');
            
            // Debugging - log the path being used
            Log::info("Firebase credentials path: {$credentialsPath}");
            
            if (!file_exists($credentialsPath)) {
                throw new Exception("Firebase credentials file not found at: {$credentialsPath}. Current directory: ".getcwd());
            }
        
            if (!is_readable($credentialsPath)) {
                throw new Exception("Firebase credentials file exists but is not readable at: {$credentialsPath}");
            }
        
            $factory = (new Factory)
                ->withServiceAccount($credentialsPath)
                ->withDatabaseUri(config('firebase.database_url'));
        
            // Initialize both services but don't throw if one fails
            try {
                $this->database = $factory->createDatabase();
            } catch (FirebaseException $e) {
                Log::error("Firebase Database initialization error: " . $e->getMessage());
            }
            
            try {
                $this->auth = $factory->createAuth();
            } catch (FirebaseException $e) {
                Log::error("Firebase Auth initialization error: " . $e->getMessage());
            }
            
            $this->initialized = true;
            
        } catch (FirebaseException $e) {
            Log::error("Firebase initialization error: " . $e->getMessage());
            throw new Exception("Failed to initialize Firebase services: " . $e->getMessage());
        }
    }

    // Database Methods (from old version)
    public function getDatabase(): Database
    {
        if (!$this->database) {
            throw new Exception("Firebase database is not initialized");
        }
        
        return $this->database;
    }

    // Auth Methods (from new version)
    public function getAuth(): Auth
    {
        if (!$this->auth) {
            throw new Exception("Firebase auth is not initialized");
        }
        return $this->auth;
    }

    /**
     * Fetch users from Firebase Auth and store in MySQL
     */
    public function fetchAndStoreUsers(): int
    {
        try {
            $count = 0;
            $auth = $this->getAuth();
            
            foreach ($auth->listUsers() as $user) {
                FirebaseUser::updateOrCreate(
                    ['firebase_uid' => $user->uid],
                    [
                        'email' => $user->email,
                        'display_name' => $user->displayName,
                        'email_verified' => $user->emailVerified,
                        'last_sign_in_at' => $user->metadata->lastLoginAt,
                    ]
                );
                $count++;
            }
            
            return $count;
            
        } catch (AuthException $e) {
            Log::error("Firebase user fetch error: " . $e->getMessage());
            throw new Exception("Failed to fetch Firebase users: " . $e->getMessage());
        }
    }

    /**
     * Get all users from MySQL
     */
    public function getAllUsers()
    {
        return FirebaseUser::orderBy('created_at', 'desc')->get();
    }

    /**
     * Check if database service is available
     */
    public function hasDatabase(): bool
    {
        return $this->database !== null;
    }

    /**
     * Check if auth service is available
     */
    public function hasAuth(): bool
    {
        return $this->auth !== null;
    }
}