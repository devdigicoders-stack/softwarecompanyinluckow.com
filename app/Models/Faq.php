<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'question',
        'answer',
        'order_index',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'order_index' => 'integer',
        ];
    }

    public static function getForPage(string $pageName): Collection
    {
        return static::where('page_name', $pageName)
            ->where('is_active', true)
            ->orderBy('order_index')
            ->orderBy('id')
            ->get();
    }
}
