<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChoose extends Model
{
    protected $fillable = [
        'whychoose_title',
        'whychoose_heading',
        'icon',
        'title',
        'description',
        'sort_order',
        'status'
    ];
}