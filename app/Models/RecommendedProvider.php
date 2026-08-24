<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecommendedProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'short_description',
        'full_description',
        'services',
        'technologies',
        'location',
        'official_website',
        'disclosure_note',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'services' => 'array',
            'technologies' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function providerLinks(): HasMany
    {
        return $this->hasMany(ProviderLink::class);
    }
}
