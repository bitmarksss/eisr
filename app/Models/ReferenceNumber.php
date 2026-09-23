<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceNumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'prefix',
        'year',
        'month',
        'last_number',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'last_number' => 'integer',
    ];
}
