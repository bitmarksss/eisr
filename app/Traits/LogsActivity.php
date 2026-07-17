<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        // Handle Creation
        static::created(function ($model) {
            static::logActivity($model, 'created', null, $model->getLoggedAttributes($model));
        });

        // Handle Updates
        static::updated(function ($model) {
            // Only log if something actually changed
            if (empty($model->getChanges())) {
                return;
            }

            // Extract old values only for the fields that changed
            $oldValues = array_intersect_key($model->getOriginal(), $model->getChanges());

            static::logActivity(
                $model,
                'updated', 
                $model->sanitizeAttributes($oldValues), 
                $model->sanitizeAttributes($model->getChanges())
            );
        });

        // Handle Deletion
        static::deleted(function ($model) {
            static::logActivity($model, 'deleted', $model->getLoggedAttributes($model), null);
        });
    }

    protected static function logActivity($model, string $action, ?array $old, ?array $new)
    {
        ActivityLog::create([
            'user_id'        => Auth::user()->id ?? 1, // Automatically captures the logged-in user; returns '1' for db:seed 
            'action'         => $action,
            'auditable_type' => get_class($model), 
            'auditable_id'   => $model->getKey(),
            'old_values'     => $old,
            'new_values'     => $new,
            'ip_address'     => Request::ip(),
            'user_agent'     => Request::userAgent(),
        ]);
    }

    // Helper to get attributes while respecting hidden fields (like passwords)
    protected function getLoggedAttributes($model): array
    {
        return $this->sanitizeAttributes($model->toArray());
    }

    // Security check: Remove passwords, tokens, etc., from logs
    protected function sanitizeAttributes(array $attributes): array
    {
        $dontLog = ['password', 'remember_token', 'two_factor_secret', 'secret'];
        return array_diff_key($attributes, array_flip($dontLog));
    }
}