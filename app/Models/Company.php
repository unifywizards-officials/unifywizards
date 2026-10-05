<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
        'name',
        'alias',
        'seocompanytitle',
        'seocompanydesc',
        'companydesc',
        'phprio',
        'description',
        'keywords',
        'person',
        'address',
        'postalcode',
        'city',
        'country_id',
        'phone',
        'fax',
        'email',
        'email_2',
        'www',
        'www_follow',
        'video_title',
        'video',
        'plate',
        'affiliate',
        'category_id',
        'subcategory_id',
        'region_id',
        'password',
        'altcategory',
        'image',
    ];

    public function categories()
{
    return $this->belongsTo(Category::class, 'category_id');
}

public function subcategories()
{
    return $this->belongsTo(Subcategory::class, 'subcategory_id');
}

public function regions()
{
    return $this->belongsTo(Region::class, 'region_id');
}

}
