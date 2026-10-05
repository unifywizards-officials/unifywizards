<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogHistory extends Model
{
    protected $fillable = [
        'blog_id',
        'user_id',
        'action',
        'blog_title',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }




}
