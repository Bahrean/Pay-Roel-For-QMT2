<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'price',
        'market_location',
        'date_recorded'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_recorded' => 'date',
        'price' => 'decimal:2'
    ];
}
