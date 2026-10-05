<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Facades\Purifier;

class ExtraFold extends Model
{
    protected $fillable = [
        'page_url',
        'title',
        'heading',
        'description',
        'image',
        'sort_order',
        'status',
        'button_name',
        'button_url'
    ];

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = $value ? Purifier::clean($value) : $value;
    }
}
