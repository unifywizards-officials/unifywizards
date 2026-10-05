<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeOurProcess extends Model
{
    use HasFactory;

    protected $fillable = [

        'sub_title',
        'title',
        'description_1',
        'description_2',
        'button_text',
        'button_link',
        'process_items',
        'status'
    ];

    protected $casts = [

        'process_items' => 'array'
    ];
}