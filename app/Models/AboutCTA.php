<?php

// app/Models/AboutCTA.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutCTA extends Model
{
    use HasFactory;

    protected $table = 'about_ctas';

    protected $fillable = [

        'small_label',
        'main_heading',
        'description',

        'button_1_text',
        'button_1_url',

        'button_2_text',
        'button_2_url',

    ];
}