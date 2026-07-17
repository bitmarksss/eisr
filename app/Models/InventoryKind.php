<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryKind extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'inventory_kinds';

    protected $fillable = [
        'kind'
    ];
}
