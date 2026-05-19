<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    protected $fillable = [
        'test_attempt_id',
        'recommendation_id',
        'pdf_path',
        'email_sent_at',
        'email_status',
    ];

    public function recommendation(): BelongsTo
    {
        return $this->belongsTo(Recommendation::class);
    }
    
    public function testAttempt(): BelongsTo
    {
        return $this->belongsTo(TestAttempt::class);
    }
 
}
 