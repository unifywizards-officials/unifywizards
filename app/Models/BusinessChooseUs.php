<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessChooseUs extends Model
{
    use HasFactory;

    protected $table = 'business_choose_us';

    protected $fillable = [
        'heading',
        'description',
        'choose_items',
        'status',
    ];

    protected $casts = [
        'choose_items' => 'array',
        'status' => 'boolean',
    ];
}