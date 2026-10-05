<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'banner_type',
        'banner_title',
        'banner_alt',
        'banner_rel',
        'banner_url',
        'keywords',
        'banner_image',
    ];

    public function company()
{
    return $this->belongsTo(Company::class, 'company_id');
}

public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}

}
