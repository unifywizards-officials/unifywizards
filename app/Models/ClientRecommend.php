<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRecommend extends Model
{
    use HasFactory;

    protected $table = 'client_recommends';

    protected $fillable = [
        'title',
        'description',
        'status',
        'clients',
    ];

    protected $casts = [
        'clients' => 'array',
        'status'  => 'boolean',
    ];
}