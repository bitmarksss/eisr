<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{ BelongsTo, HasMany };
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $table = 'inventory_items';

    protected $fillable = [
        'item_code',
        'name',
        'category',
        'quantity',
        'uom'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function kind(): BelongsTo
    {
        return $this->belongsTo(InventoryKind::class);
    }

    public function stock(): HasMany
    {
        return $this->hasMany(InventoryStock::class);
    }
}
