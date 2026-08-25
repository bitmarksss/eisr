<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class DailyReportsHeader extends Model
{
    use HasFactory;

    protected $fillable = ['report_date', 'location_id'];
    protected $casts = ['report_date' => 'date'];

    public function location(): BelongsTo { return $this->belongsTo(Location::class); }
    public function details(): HasMany { return $this->hasMany(DailyReportsDetail::class, 'header_id'); }
}
