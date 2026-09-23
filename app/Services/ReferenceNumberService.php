<?php
namespace App\Services;

use App\Models\ReferenceNumber;
use Illuminate\Support\Facades\DB;

class ReferenceNumberService
{
    public function generate(string $type, string $prefix): string
    {
        $now = now();
        $year = $now->format('y');
        $month = $now->month;

        return DB::transaction(function () use ($type, $prefix, $now, $year, $month) {
            
            // 1. Safely find or create the sequence row to avoid concurrent insertion crashes.
            // firstOrCreate inside a transaction with a unique key handles race conditions cleanly.
            $sequence = ReferenceNumber::where('type', $type)
                ->where('year', $year)
                ->where('month', $month)
                ->lockForUpdate()
                ->first();

            if (! $sequence) {
                // Use firstOrCreate to prevent race conditions if two threads hit this simultaneously
                $sequence = ReferenceNumber::firstOrCreate(
                    [
                        'type' => $type,
                        'year' => $year,
                        'month' => $month,
                    ],
                    [
                        'prefix' => $prefix,
                        'last_number' => 0,
                    ]
                );
                
                // Re-lock the newly created row to ensure safe incrementing
                $sequence = ReferenceNumber::where('id', $sequence->id)
                    ->lockForUpdate()
                    ->first();
            }

            // 2. Increment the sequence safely
            $sequence->increment('last_number');
            
            // Refresh to get the latest updated increment value
            $sequence->refresh();

            // Note: Your format asks for 4-digit or 2-digit year? 
            // PMC-OEC-(y)-(m)-(3 digit) -> Y format uses 4 digits (2026), y uses 2 digits (26).
            // Let's use 4 digits based on your initial prompt, or match format accordingly:
            return sprintf(
                '%s-%s-%02d-%03d',
                $prefix,
                $year,
                $month,
                $sequence->last_number
            );
        });
    }
}