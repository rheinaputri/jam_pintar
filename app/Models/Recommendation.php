<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recommendation extends Model
{
    protected $fillable = [
        'prefered_study_time',
        'recomendation',
        'study_hour_start',
        'study_hour_end',
        'alt_study_hour_start',
        'alt_study_hour_end',
    ];
 
    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
    