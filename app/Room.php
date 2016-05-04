<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price'];

    protected $casts = [
        'price' => 'float',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function booking($data)
    {
        return $this->bookings()->create([
            'date' => $data['date'],
            'status' => Booking::LOCKED,
            'email' => $data['email'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }
}
