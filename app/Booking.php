<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    const LOCKED = 1;
    const RESERVED = 2;

    protected $fillable = ['date', 'status', 'email', 'name', 'phone', 'address', 'trade'];

    protected $casts = [
        'status' => 'integer',
        'room_id' => 'integer',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
