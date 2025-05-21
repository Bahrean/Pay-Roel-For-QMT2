<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

        protected $fillable = [
        'firebase_key',
        'username',
        'email',
        'phone',
        'address',
        'last_purchase_at'
    ];
}
