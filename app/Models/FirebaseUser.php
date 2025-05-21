<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirebaseUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'firebase_uid',
        'email',
        'display_name',
        'email_verified',
        'last_sign_in_at'
    ];

    protected $casts = [
        'email_verified' => 'boolean',
        'last_sign_in_at' => 'datetime'
    ];
}
