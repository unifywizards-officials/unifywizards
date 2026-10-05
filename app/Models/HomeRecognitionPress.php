<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeRecognitionPress extends Model
{
    use HasFactory;

    protected $fillable = [

        'sub_title',
        'title',
        'description',
        'press_items',
        'status'
    ];

    protected $casts = [

        'press_items' => 'array'
    ];
}