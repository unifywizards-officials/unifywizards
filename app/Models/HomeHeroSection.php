<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroSection extends Model
{
    protected $table = 'home_hero_sections';

    protected $fillable = [

    'sub_title',
    'title',
    'highlight_text',
    'description',
    'hero_image',
    'pattern_shape',
    'customer_count',
    'customer_text',
    'customer_images',
    'award_images',
    'status',
];

    protected $casts = [

        'customer_images' => 'array',
        'award_images' => 'array',
    ];
}