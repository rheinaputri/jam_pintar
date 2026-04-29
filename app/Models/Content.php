<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'type',
        'title',
        'text',
        'image',
        'order',
    ];
 
    protected $casts = [
        'type' => 'string',
        'order' => 'integer',
    ];
}

