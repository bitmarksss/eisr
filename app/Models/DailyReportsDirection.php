<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReportsDirection extends Model
{
    use HasFactory;

    protected $fillable = ['detail_id', 'direction', 'type', 'distance'];
    protected $casts = ['distance' => 'integer'];

    public function detail(): BelongsTo { return $this->belongsTo(DailyReportsDetail::class, 'detail_id'); }
}
