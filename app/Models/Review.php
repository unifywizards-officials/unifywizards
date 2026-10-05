<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'badge',
        'heading',
        'description_1',
        'description_2',
        'review_items',       // JSON — platform reviews array
        'testimonial_items',  // JSON — testimonials array
        'retention_rate',
        'satisfaction_rate',
    ];

    // Auto cast JSON columns to array
    protected $casts = [
        'review_items'      => 'array',
        'testimonial_items' => 'array',
    ];

    /**
     * Always get or create the single settings row (id=1)
     */
    public static function getSingle(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }




}
