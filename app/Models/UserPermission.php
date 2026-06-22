<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserPermission extends Model
{
    // Keeping this false because Laravel expects a single auto-incrementing 'id' by default
    public $incrementing = false; 
    
    protected $fillable = [
        'user_id', 
        'module_type', 
        'can_create', 
        'can_read', 
        'can_update', 
        'can_delete', 
        'custom_permissions'
    ];

    protected $casts = [
        'can_create' => 'boolean',
        'can_read' => 'boolean',
        'can_update' => 'boolean',
        'can_delete' => 'boolean',
        'custom_permissions' => 'array', 
    ];

    /**
     * Scope a query to only include permissions for a specific module type.
     */
    public function scopeOfModule(Builder $query, string $module): Builder 
    { 
        // Changed from LIKE to exact match for performance and reliability
        return $query->where('module_type', $module);
    }
}