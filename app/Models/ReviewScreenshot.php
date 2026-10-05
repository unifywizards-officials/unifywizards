<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewScreenshot extends Model
{
    protected $fillable = [
        'heading',
        'highlight_text',
        'description',
        'images',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
    ];
}
