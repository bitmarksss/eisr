<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{ BelongsTo, HasMany };

class InventoryStock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_id',
        'location',
        'quantity',
    ];

    /**
     * Get the inventory item that owns this stock.
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }
}