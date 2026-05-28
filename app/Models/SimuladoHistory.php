<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SimuladoHistory extends Model
{
    protected $fillable = [
        'user_id', 'total_questions', 'correct_answers',
        'time_spent', 'question_ids', 'answers',
    ];

    protected $casts = [
        'question_ids' => 'array',
        'answers'      => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getScorePercentAttribute(): int
    {
        return $this->total_questions > 0
            ? (int) round(($this->correct_answers / $this->total_questions) * 100)
            : 0;
    }

    public function getFormattedTimeAttribute(): string
    {
        return gmdate($this->time_spent >= 3600 ? 'H:i:s' : 'i:s', $this->time_spent);
    }
}
