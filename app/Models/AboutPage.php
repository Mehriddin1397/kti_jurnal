<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use \App\Traits\Translatable;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getTitleAttribute(): string
    {
        return $this->getTranslated('title');
    }

    public function getDescriptionAttribute(): string
    {
        return $this->getTranslated('description');
    }

    public function getBodyAttribute(): string
    {
        return $this->getTranslated('body');
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
