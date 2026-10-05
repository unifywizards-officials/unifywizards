<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentAward extends Model
{
    use HasFactory;

    protected $table = 'recent_awards';

    protected $fillable = [
        'title',
        'description',
        'awards',
    ];

    protected $casts = [
        'awards' => 'array',
    ];
}