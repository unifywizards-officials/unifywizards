<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DmPage extends Model
{
    use SoftDeletes;

    protected $table = 'dm_pages';

    // ── Fillable ───────────────────────────────────────────────────────────────
    protected $fillable = [
        'header_menu',
        'service_type',
        'page_name',
        'slug',
        'is_active',
        'footer_status',

        // Sections
        's1_banner',
        's2_top_services',
        's3_industries',
        's4_about',
        's5_testimonials',
        's6_our_company',
        's7_proud_projects',
        's8_powered_by',
        's9_who_should_invest',
        's10_why_choose',
        's11_wizards_spell',
        's12_cta',
        's13_technologies',
        's14_our_process',
        's15_development_items',
    ];

    // ── Casts — JSON columns auto convert to PHP array ────────────────────────
    // $page->s2_top_services['items'] directly karo, json_decode ki zaroorat nahi
    protected $casts = [
        'is_active'            => 'boolean',
        's1_banner'            => 'array',
        's2_top_services'      => 'array',
        's3_industries'        => 'array',
        's4_about'             => 'array',
        's5_testimonials'      => 'array',
        's6_our_company'       => 'array',
        's7_proud_projects'    => 'array',
        's8_powered_by'        => 'array',
        's9_who_should_invest' => 'array',
        's10_why_choose'       => 'array',
        's11_wizards_spell'    => 'array',
        's12_cta'              => 'array',
        's13_technologies' => 'array',
        's14_our_process' => 'array',
        's15_development_items' => 'array',
    ];


// Header Menu Options select


public static function headerMenus(): array
{
    return [
        'marketing'            => 'Marketing',
        'design_and_branding' => 'Design and Branding',
        'development'         => 'Development',
        'ai'                  => 'AI',
    ];
}

    // ── Service type options (form select ke liye) ────────────────────────────
    public static function serviceTypes(): array
{
    return [

        // Marketing
        'marketing' => [
            'digital_marketing' => 'Digital Marketing',
            'paid_advertising'  => 'Paid Advertising',
            'online_marketing'  => 'Online Marketing',
            'case_studies'      => 'Case Studies',
        ],

        // Design & Branding
        'design_and_branding' => [
            'branding'                 => 'Branding',
            'graphic_design'           => 'Graphic Design',
            'creative_media_services' => 'Creative & Media Services',
            'case_studies'             => 'Case Studies',
        ],

        // Development
        'development' => [
            'by_website_goal' => 'By Website Goal',
            'by_platforms'    => 'By Platforms',
            'by_industry'     => 'By Industry',
            'case_studies'    => 'Case Studies',
        ],

        // AI
        'ai' => [
            'ai_services' => 'AI Services',
            'ai_solutions' => 'AI Solutions',
            'case_study' => 'Case Study',
        ],

    ];
}


public function blogs()
{
    return $this->hasMany(
        Blog::class,
        'service_page_id'
    );
}
    // ── Scopes ─────────────────────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('service_type', $type);
    }

    public function scopeBySlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    // ── Helpers ────────────────────────────────────────────────────────────────

    // Service type ka readable label
    public function getServiceTypeLabelAttribute(): string
    {
        return self::serviceTypes()[$this->service_type] ?? $this->service_type;
    }

    // Kisi bhi section ke nested array ko safely access karo null-safe
    // e.g. $page->section('s2_top_services', 'items', [])
    public function section(string $column, string $key = null, mixed $default = null): mixed
    {
        $data = $this->{$column} ?? [];
        if ($key === null) return $data;
        return $data[$key] ?? $default;
    }
}
