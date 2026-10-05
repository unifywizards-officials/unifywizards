<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Main Section Data
        |--------------------------------------------------------------------------
        */

        'client_title',

        'client_heading',

        /*
        |--------------------------------------------------------------------------
        | Item List
        |--------------------------------------------------------------------------
        */

        'name',

        'logo',

        'website',

        'sort_order',

        'status'
    ];
}