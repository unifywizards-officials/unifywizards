<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'dm_pages';
    protected $fillable = [
        'active',
        'company_id',
        'category_id',
        'description',
        'video_title',
        'you_tube_url',
        'image',
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
