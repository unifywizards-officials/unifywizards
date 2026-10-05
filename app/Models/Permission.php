<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
        'group',
        'description',
    ];

    protected $casts = [
        'group' => 'string',
    ];

    /**
     * Scope a query to filter by group.
     */
    public function scopeGroup($query, string $group)
    {
        return $query->where('group', $group);
    }
}