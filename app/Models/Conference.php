<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Conference extends Model
{
    use \App\Traits\Translatable;

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'submission_deadline' => 'date',
        'registration_deadline' => 'date',
        'is_online' => 'boolean',
    ];

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

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'active' => 'green',
            'upcoming' => 'blue',
            'closed' => 'gray',
            'archived' => 'red',
            default => 'gray',
        };
    }
}
