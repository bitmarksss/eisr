<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{ BelongsTo, HasMany };

class UnitOfMeasurement extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'uoms';
    protected $fillable = ['unit'];

    
    public function item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'uom');
    }
}
