<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use \App\Traits\Translatable;

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'date',
        'received_at' => 'date',
        'accepted_at' => 'date',
        'is_open_access' => 'boolean',
        'view_count' => 'integer',
        'download_count' => 'integer',
    ];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)
            ->withPivot('order', 'is_corresponding', 'organization')
            ->orderByPivot('order');
    }

    public function correspondingAuthor()
    {
        return $this->authors()->wherePivot('is_corresponding', true)->first();
    }

    public function getAuthorsStringAttribute(): string
    {
        return $this->authors->map(fn($a) => $a->last_name . ', ' . $a->first_name)->join('; ');
    }

    public function getPdfUrlAttribute(): string
    {
        return $this->pdf_file
            ? Storage::disk('public')->url($this->pdf_file)
            : '';
    }

    public function getTitleAttribute(): string
    {
        return $this->getTranslated('title');
    }

    public function getAbstractAttribute(): string
    {
        return $this->getTranslated('abstract');
    }

    public function getMetaTitleAttribute(): string
    {
        return $this->title_en ?: $this->title_uz ?? '';
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'published' => 'green',
            'accepted' => 'blue',
            'under_review' => 'yellow',
            'rejected' => 'red',
            default => 'gray',
        };
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['search'])) {
            $s = $filters['search'];
            $query->where(function ($q) use ($s) {
                $q->where('title_uz', 'LIKE', "%{$s}%")
                    ->orWhere('title_en', 'LIKE', "%{$s}%")
                    ->orWhere('keywords_uz', 'LIKE', "%{$s}%")
                    ->orWhere('keywords_en', 'LIKE', "%{$s}%");
            });
        }
        if (!empty($filters['journal_id'])) {
            $query->where('journal_id', $filters['journal_id']);
        }
        if (!empty($filters['year'])) {
            $query->whereYear('published_at', $filters['year']);
        }
        if (!empty($filters['language'])) {
            $query->where('language', $filters['language']);
        }
        if (!empty($filters['article_type'])) {
            $query->where('article_type', $filters['article_type']);
        }
        return $query;
    }
}
