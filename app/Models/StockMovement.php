<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{ BelongsTo, HasMany };

class StockMovement extends Model
{
    use HasFactory, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $table = 'stock_movement_headers';

    protected $fillable = [
        'reference_no',
        'movement_date',
        'type',
        'level_id',
        'status',
        'user_id',
        'notes',
    ];

    /**
     * Get the line items associated with this movement session.
     */
    public function items(): HasMany
    {
        return $this->hasMany(StockMovementItem::class, 'stock_movement_id');
    }

    /**
     * Get the user who authorized/logged this movement.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(StockMovementApproval::class);
    }
}
