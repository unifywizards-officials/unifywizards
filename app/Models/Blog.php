<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [

        'service_page_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'status',
        'user_id',
        'published_at',

        // SEO
        'focus_keyword',
        'seo_score',
        'seo_checks',

        // Readability
        'readability_errors',
        'readability_checks',
        'title_checks',
    ];

    protected $casts = [

        'published_at'       => 'datetime',

        'seo_checks'         => 'array',
        'readability_checks' => 'array',
        'title_checks'       => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {

            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });

        static::updating(function ($blog) {

            if ($blog->isDirty('title')) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }


    public function service()
{
    return $this->belongsTo(
        DmPage::class,
        'service_page_id'
    );
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }
    
    
public function histories()
{
    return $this->hasMany(BlogHistory::class);
}
    
    
    
    
    
}