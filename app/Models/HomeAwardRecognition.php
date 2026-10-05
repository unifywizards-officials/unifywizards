<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Facades\Purifier;

class HomeAwardRecognition extends Model
{
    use HasFactory;

    protected $fillable = [

        'sub_title',
        'title',
        'description',
        'button_text',
        'button_link',
        'bottom_text',
        'award_items',
        'status'
    ];

    protected $casts = [

        'award_items' => 'array'
    ];

    public function setBottomTextAttribute($value)
    {
        $this->attributes['bottom_text'] = $value ? Purifier::clean($value) : $value;
    }
}