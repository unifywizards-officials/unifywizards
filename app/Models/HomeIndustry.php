<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeIndustry extends Model
{
    protected $fillable = [

        'sub_title',
        'title',
        'button_text',
        'button_link',
        'industries',
        'status'
    ];

    protected $casts = [

        'industries' => 'array',
        'status' => 'boolean'
    ];
}