<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReportDirection extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['detail_id', 'direction', 'type', 'distance'];
    protected $casts = ['distance' => 'integer'];

    public function detail(): BelongsTo { return $this->belongsTo(DailyReportDetail::class, 'detail_id'); }
}
