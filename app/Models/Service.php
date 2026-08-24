<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
        'features',
        'technologies',
        'process',
        'benefits',
        'industries',
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
            'features' => 'array',
            'technologies' => 'array',
            'process' => 'array',
            'benefits' => 'array',
            'industries' => 'array',
            'faqs' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
