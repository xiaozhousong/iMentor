<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    const STATUS = [
        'booked' => 0,
        'attendant' => 1,
        'absent' => 2,
        'pending' => 3,
        'cancel' => 4
    ];

    const REASON = [
        'assignment' => 'Assignment',
        'deadline' => 'Deadline',
        'general' => 'General',
        'others' => 'Others',
    ];

    const Level = [
        'extremely' => 'Extremely important',
        'very' => 'Very Important',
        'quite' => 'Quite Important',
        'import' => 'Important',
        'unimportant' => 'Unimportant',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class, 'availability_id');
    }
}
