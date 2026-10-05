<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;
    protected $table = 'tenders';
    protected $fillable = [
        'status',
        'company_id',
        'category_id',
        'type',
        'title',
        'information',
        'image',
        'date',
        'headline',
        'keywords',
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
