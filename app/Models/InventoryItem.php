<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{ BelongsTo, HasMany };
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'inventory_items';

    protected $fillable = [
        'item_code',
        'supplier_id',
        'name',
        'kind_id',
        'cost',
        'uom',
        // 'quantity',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function kind(): BelongsTo
    {
        return $this->belongsTo(InventoryKind::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasurement::class, 'uom');
    }

    public function stock(): HasMany
    {
        return $this->hasMany(InventoryStock::class, 'item_id');
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'inventory_stocks', 'item_id', 'level_id')
                    ->withPivot('location', 'quantity')
                    ->withTimestamps();
    }
}
