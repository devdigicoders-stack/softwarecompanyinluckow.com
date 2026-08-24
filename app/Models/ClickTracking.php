<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClickTracking extends Model
{
    use HasFactory;

    protected $table = 'click_tracking';

    protected $fillable = [
        'provider_link_id',
        'target_url',
        'referrer_url',
        'cta_type',
        'user_ip',
        'user_agent',
    ];

    public function providerLink(): BelongsTo
    {
        return $this->belongsTo(ProviderLink::class);
    }
}
