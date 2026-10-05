<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTestimonial extends Model
{
    protected $fillable = [

        'sub_title',
        'title',
        'highlight_text',
        'testimonials_json',
        'status',
    ];

    protected $casts = [

        'testimonials_json' => 'array',
        'status'            => 'boolean',
    ];
}