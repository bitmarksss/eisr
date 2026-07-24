<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovementItem extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stock_movement_id',
        'item_id',
        'source_location',
        'source_level_id',
        'destination_location',
        'destination_level_id',
        'quantity',
        'remarks',
    ];

    /**
     * The accessors to append to the model's array form for instant UI consumption.
     */
    protected $appends = ['item_name', 'unit', 'destination_level_name'];

    // --- Relationships ---

    /**
     * Get the movement header record.
     */
    public function movement(): BelongsTo
    {
        return $this->belongsTo(StockMovement::class, 'stock_movement_id');
    }

    /**
     * Get the inventory item being moved.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'item_id');
    }

    /**
     * Get the source level (null if originating from Surface).
     */
    public function sourceLevel(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'source_level_id');
    }

    /**
     * Get the target level (null if transferred to Surface).
     */
    public function destinationLevel(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'destination_level_id');
    }

    // --- Dynamic Attribute Accessors ---

    protected function itemName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->item?->name
        );
    }

    protected function unit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->item?->unit?->unit
        );
    }

    protected function destinationLevelName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->destinationLevel?->name ?? 'Surface Warehouse'
        );
    }
}