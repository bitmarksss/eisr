<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovementApproval extends Model
{
    protected $fillable = ['stock_movement_id', 'user_id', 'status', 'approved_at', 'remarks'];

    protected $casts = ['approved_at' => 'datetime'];

    
    public function movement(): BelongsTo 
    {
        return $this->belongsTo(StockMovement::class, 'stock_movement_id'); 
    }
    
    public function user(): BelongsTo 
    { 
        return $this->belongsTo(User::class); 
    }
}
