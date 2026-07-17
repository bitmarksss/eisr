<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{ BelongsTo, HasMany };

class InventoryStock extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'item_id',
        'location',
        'level_id',
        'quantity',
    ];

    protected $appends = ['name', 'kind', 'cost', 'unit'];

    /**
     * Get the inventory item that owns this stock.
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }

    /**
     * Get the level holds this stock.
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    // Attribute shortcuts
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->inventory?->name
        );
    }

    protected function supplier(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->inventory?->supplier
        );
    }

    protected function kind(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->inventory?->kind
        );
    }

    protected function cost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->inventory?->cost
        );
    }

    protected function unit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->inventory?->unit->unit
        );
    }
}