<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // ✅ Add user_id to allow mass assignment
    protected $fillable = [
        'title',
        'description',
        'booking_date',
        'user_id',
    ];

    // (Optional) If booking_date is a datetime, cast it
    protected $casts = [
        'booking_date' => 'datetime',
    ];

    // (Optional) Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
