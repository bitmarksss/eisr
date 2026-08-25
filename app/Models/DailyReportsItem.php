<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReportsItem extends Model
{
    use HasFactory;

    protected $fillable = ['detail_id', 'item_id', 'quantity'];
    protected $casts = ['quantity' => 'decimal:2'];

    public function detail(): BelongsTo { return $this->belongsTo(DailyReportsDetail::class, 'detail_id'); }
    public function item(): BelongsTo { return $this->belongsTo(InventoryItem::class, 'item_id'); }
}
