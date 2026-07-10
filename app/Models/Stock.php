<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'kind',
        'type',
        'quantity',
        'uom_id',
        'user_id',
        'remarks',
        'prepared_by',
        'reviewed_by',
        'noted_by',
        'endorsed_by',
        'approved_by',
        'noted_by_2',
        'approved_by_2',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'array',
    ];

    /**
     * Get the unit of measure associated with the stock request.
     */
    public function uom(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasurement::class, 'uom_id');
    }

    /**
     * Get the user who owns the stock request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user who prepared the request.
     */
    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }

    /**
     * Get the user who reviewed the request.
     */
    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the user who noted the request.
     */
    public function notedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'noted_by');
    }

    /**
     * Get the user who endorsed the request.
     */
    public function endorsedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'endorsed_by');
    }

    /**
     * Get the user who approved the request.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the second user who noted the request.
     */
    public function notedBy2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'noted_by_2');
    }

    /**
     * Get the second user who approved the request.
     */
    public function approvedBy2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_2');
    }
}