<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogForm extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'service',
        'message',
        'blog_ref',
    ];
}