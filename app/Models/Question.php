<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = ['statement', 'year', 'course_id', 'component', 'explanation', 'is_featured', 'order', 'times_answered'];

    protected $casts = ['is_featured' => 'boolean'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function alternatives(): HasMany
    {
        return $this->hasMany(Alternative::class);
    }
}
