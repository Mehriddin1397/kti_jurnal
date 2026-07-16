<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journal extends Model
{
    use \App\Traits\Translatable;

    protected $guarded = ['id'];

    protected $casts = [
        'is_indexed_google_scholar' => 'boolean',
        'is_indexed_hak' => 'boolean',
        'is_indexed_inlibrary' => 'boolean',
        'is_indexed_scopus' => 'boolean',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function publishedArticles(): HasMany
    {
        return $this->hasMany(Article::class)->where('status', 'published');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function aboutPages(): HasMany
    {
        return $this->hasMany(AboutPage::class);
    }

    public function getNameAttribute(): string
    {
        return $this->getTranslated('name');
    }

    public function getDescriptionAttribute(): string
    {
        return $this->getTranslated('description');
    }
}
