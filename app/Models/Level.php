<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory, LogsActivity; // Logs activity automatically on save/update/delete

    protected $fillable = [
        'name',
        'code',
        'sort_order',
        'description',
        'is_active',
    ];

    protected $table = 'locations';

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
