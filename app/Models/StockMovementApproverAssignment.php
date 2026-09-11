<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;

class StockMovementApproverAssignment extends Model
{
    protected $fillable = ['approver_slot', 'user_id'];

    protected $casts = [
        'user_id' => 'integer',
        'approver_slot' => 'integer',
    ];
    
    public function user(): BelongsTo 
    { 
        return $this->belongsTo(User::class); 
    }
}
