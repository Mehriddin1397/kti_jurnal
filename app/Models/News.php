<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use \App\Traits\Translatable;

    protected $guarded = ['id'];
    protected $table = 'news';

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function getTitleAttribute(): string
    {
        return $this->getTranslated('title');
    }

    public function getBodyAttribute(): string
    {
        return $this->getTranslated('body');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at');
    }
}
