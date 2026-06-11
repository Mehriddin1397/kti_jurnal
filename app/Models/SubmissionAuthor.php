<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionAuthor extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'submission_authors';

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
