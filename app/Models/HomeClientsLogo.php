<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeClientsLogo extends Model
{
    protected $table = 'home_clients_logos';

    protected $fillable = [

        'title',
        'highlight_number',
        'highlight_text',
        'logos',
        'status',
    ];

    protected $casts = [

        'logos' => 'array',
    ];
}