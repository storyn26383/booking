<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['type', 'data'];

    protected $casts = [
        'data' => 'json',
    ];
}
