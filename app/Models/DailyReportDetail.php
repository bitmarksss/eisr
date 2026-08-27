<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class DailyReportDetail extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['header_id', 'contractor_name', 'support', 'drill_steel', 'working_place'];
    protected $casts = ['drill_steel' => 'integer'];

    public function header(): BelongsTo { return $this->belongsTo(DailyReportHeader::class, 'header_id'); }
    public function items(): HasMany { return $this->hasMany(DailyReportItem::class, 'detail_id'); }
    public function directions(): HasMany { return $this->hasMany(DailyReportDirection::class, 'detail_id'); }
}
