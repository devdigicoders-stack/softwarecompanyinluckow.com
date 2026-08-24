<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMetadata extends Model
{
    use HasFactory;

    protected $table = 'seo_metadatas';

    protected $fillable = [
        'route_name',
        'meta_title',
        'meta_description',
        'canonical_url',
        'og_image',
        'schema_settings',
    ];

    protected function casts(): array
    {
        return [
            'schema_settings' => 'array',
        ];
    }
}
