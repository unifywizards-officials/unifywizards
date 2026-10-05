<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';
    protected $fillable = [
        'status',
        'company_id',
        'date',
        'information',
        'title',
        'address',
        'phone',
        'web',
        'city',
        'image',
    ];

    public function company()
{
    return $this->belongsTo(Company::class, 'company_id');
}


}
