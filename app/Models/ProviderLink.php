<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProviderLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'recommended_provider_id',
        'anchor_text',
        'target_url',
        'service_category',
        'context_notes',
        'click_count',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'click_count' => 'integer',
        ];
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(RecommendedProvider::class, 'recommended_provider_id');
    }

    public function clickTrackings(): HasMany
    {
        return $this->hasMany(ClickTracking::class);
    }
}
