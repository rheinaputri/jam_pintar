<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TestAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'started_at',
        'finished_at',
    ];
 
    protected function casts(): array
    {
        return [
            'started_at'  => 'datetime',
            'finished_at' => 'datetime',
        ];
    }
 
    //relasi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
 
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
 
    // hasOne karena 1 attempt hanya punya 1 result (dan tidak selalu ada)
    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }

    //helper
    public function isFinished(): bool
    {
        return $this->finished_at !== null;
    }
 
    public function hasResult(): bool
    {
        return $this->result()->exists();
    }
}