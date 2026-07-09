<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryKind extends Model
{
    use HasFactory;

    protected $table = 'inventory_kinds';

    protected $fillable = [
        'kind'
    ];
}
