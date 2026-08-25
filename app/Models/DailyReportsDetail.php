<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class DailyReportsDetail extends Model
{
    use HasFactory;

    protected $fillable = ['header_id', 'contractor_name', 'support', 'drill_steel', 'working_place'];
    protected $casts = ['drill_steel' => 'integer'];

    public function header(): BelongsTo { return $this->belongsTo(DailyReportsHeader::class, 'header_id'); }
    public function items(): HasMany { return $this->hasMany(DailyReportsItem::class, 'detail_id'); }
    public function directions(): HasMany { return $this->hasMany(DailyReportsDirection::class, 'detail_id'); }
}
