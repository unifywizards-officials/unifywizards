<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    protected $table = 'introduction';

  protected $fillable = [
    'type',
    'name',
    'title',
    'icon',
    'heading',
    'long_description',
    'image',
    'number',
    'suffix',
    'stats_items',
    'sort_order',
    'status'
];

protected $casts = [
    'stats_items' => 'array',
];


}