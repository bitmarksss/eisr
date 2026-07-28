<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * The accessors to append to the model's array form.
     * Includes 'supplier' just in case you use it down the line.
     */
    protected $appends = ['name', 'kind', 'cost', 'unit', 'supplier'];

    /**
     * Get the inventory item that owns this stock record.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }

    /**
     * Get the mine level holding this specific stock assignment.
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    // --- Dynamic Attribute Accessors ---

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->item?->name
        );
    }

    protected function supplier(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->item?->supplier
        );
    }

    protected function kind(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->item?->kind
        );
    }

    protected function cost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->item?->cost
        );
    }

    protected function unit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->item?->unit?->unit
        );
    }
}