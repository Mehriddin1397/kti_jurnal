<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'submission_deadline' => 'date',
        'registration_deadline' => 'date',
        'is_online' => 'boolean',
    ];

    public function getTitleAttribute(): string
    {
        return $this->title_uz ?: $this->title_en ?? '';
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
