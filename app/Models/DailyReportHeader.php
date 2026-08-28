<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class DailyReportHeader extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['report_date', 'level_id', 'prepared_by'];
    protected $casts = ['report_date' => 'date'];

    public function level(): BelongsTo { 
        return $this->belongsTo(Level::class); 
    }
    
    public function details(): HasMany { 
        return $this->hasMany(DailyReportDetail::class, 'header_id'); 
    }
    
    public function owner(): BelongsTo { 
        return $this->belongsTo(User::class, 'prepared_by'); 
    }
}
