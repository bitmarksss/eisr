<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReportItem extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['detail_id', 'item_id', 'quantity'];
    protected $casts = ['quantity' => 'decimal:2'];

    public function detail(): BelongsTo { return $this->belongsTo(DailyReportDetail::class, 'detail_id'); }
    public function item(): BelongsTo { return $this->belongsTo(InventoryItem::class, 'item_id'); }
}
