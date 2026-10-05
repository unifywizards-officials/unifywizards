<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCompanyOverview extends Model
{
    use HasFactory;

    protected $fillable = [

        'sub_title',
        'title',
        'button_text',
        'button_link',
        'main_image',
        'video_url',
        'customer_bg',
        'customer_text',
        'customer_images',
        'counters',
        'status'
    ];

    protected $casts = [

        'customer_images' => 'array',

        'counters' => 'array'
    ];
}