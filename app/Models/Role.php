<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
        'description',
        'is_super_admin',
    ];

    protected $casts = [
        'is_super_admin' => 'boolean',
    ];

    /**
     * Scope a query to only include super admin roles.
     */
    public function scopeSuperAdmin($query)
    {
        return $query->where('is_super_admin', true);
    }
}