<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getTitleAttribute(): string
    {
        return $this->title_uz ?: $this->title_en ?: $this->title_ru ?? '';
    }

    public function getDescriptionAttribute(): string
    {
        return $this->description_uz ?: $this->description_en ?: $this->description_ru ?? '';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
