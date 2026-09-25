<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockRequest extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'stock_request_headers';

    protected $fillable = [
        'reference_no',
        'date',
        'requested_by',
        'notes',
        'no_additional_notes',
    ];

    protected $casts = [
        'date' => 'date',
        'notes' => 'array',
        'no_additional_notes' => 'boolean',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(StockRequestItem::class, 'stock_request_id');
    }
}
