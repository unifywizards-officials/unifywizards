<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'description',
        'image',
        'button_text',
        'button_link',
        'button_text2',
        'button_link2',
        'status'
    ];
}