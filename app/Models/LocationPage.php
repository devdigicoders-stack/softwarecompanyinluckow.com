<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_name',
        'slug',
        'h1_title',
        'tagline',
        'excerpt',
        'content',
        'local_highlights',
        'services_offered',
        'faqs',
        'meta_title',
        'meta_description',
        'canonical_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'local_highlights' => 'array',
            'services_offered' => 'array',
            'faqs' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
