<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryType extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'inventory_types';

    protected $fillable = [
        'type',
        'created_by',
        'updated_by',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(InventoryItem::class, 'type_id');
    }
}
