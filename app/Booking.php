<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    const LOCKED = 1;
    const RESERVED = 2;

    protected $fillable = ['date', 'status', 'email', 'name', 'phone', 'address'];

    protected $casts = [
        'status' => 'integer',
        'room_id' => 'integer',
    ];
}
