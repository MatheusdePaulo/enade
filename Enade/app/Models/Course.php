<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = ['name'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
