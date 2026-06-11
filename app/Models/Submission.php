<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submission extends Model
{
    protected $guarded = ['id'];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }

    public function authors(): HasMany
    {
        return $this->hasMany(SubmissionAuthor::class)->orderBy('order');
    }

    public function correspondingAuthor()
    {
        return $this->authors()->where('is_corresponding', true)->first();
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'accepted' => 'green',
            'under_review' => 'yellow',
            'revision' => 'blue',
            'rejected' => 'red',
            default => 'gray',
        };
    }
}
