<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchModuleByEmployee
{
    /**
     * Scope a query to search by employee code or name.
     */
    public function scopeSearchModuleByEmployee(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function ($query) use ($search) {
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('employee_code', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%");
            });
        });
    }
}