<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'admin_email',
        'admin_name',
        'event_type',
        'description',
        'login_at',
        'logout_at',
        'session_duration',
        'ip_address',
        'user_agent',
        'browser',
        'device_os',
        'latitude',
        'longitude',
        'location_address',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'login_at' => 'datetime',
            'logout_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get human-readable session duration (e.g. 01h 15m 30s).
     */
    public function getFormattedDurationAttribute(): string
    {
        if ($this->login_at) {
            $endTime = $this->logout_at ?? now();
            $diffInSeconds = max(0, (int) $this->login_at->diffInSeconds($endTime));

            $hours = floor($diffInSeconds / 3600);
            $minutes = floor(($diffInSeconds % 3600) / 60);
            $seconds = $diffInSeconds % 60;

            return sprintf('%02dh %02dm %02ds', $hours, $minutes, $seconds);
        }

        if ($this->session_duration) {
            if (is_numeric($this->session_duration)) {
                $seconds = (int) $this->session_duration;
                $hours = floor($seconds / 3600);
                $minutes = floor(($seconds % 3600) / 60);
                $secs = $seconds % 60;

                return sprintf('%02dh %02dm %02ds', $hours, $minutes, $secs);
            }

            return (string) $this->session_duration;
        }

        return 'N/A';
    }
}
