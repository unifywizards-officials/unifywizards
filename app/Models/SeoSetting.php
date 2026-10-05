<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
    'page_name',
    'page_slug',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'canonical_url',
    'robots',
    'og_title',
    'og_description',
    'og_image',
];

}
