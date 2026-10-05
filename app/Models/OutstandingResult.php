<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutstandingResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'description',
        'results',
        'status',
    ];

    protected $casts = [
        'results' => 'array',
        'status' => 'boolean',
    ];
}