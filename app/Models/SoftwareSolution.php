<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftwareSolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'h1_title',
        'tagline',
        'excerpt',
        'content',
        'icon',
        'featured_image',
        'target_audience',
        'features',
        'benefits',
        'pricing_factors',
        'faqs',
        'meta_title',
        'meta_description',
        'canonical_url',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'target_audience' => 'array',
            'features' => 'array',
            'benefits' => 'array',
            'pricing_factors' => 'array',
            'faqs' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
