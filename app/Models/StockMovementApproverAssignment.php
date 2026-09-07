<?php

namespace AppModels;

use IlluminateDatabaseEloquentModel;
use IlluminateDatabaseEloquentRelationsBelongsTo;

class StockMovementApproverAssignment extends Model
{
    protected $fillable = ['approver_slot', 'user_id'];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
