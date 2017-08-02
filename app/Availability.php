<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $table = 'availabilities';

    const LENGTH = ['10min', '15min', '20min', '30min'];

    public function tutor()
    {
        return $this->belongsTo('App\Tutor');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'availability_id', 'user_id')->withPivot([
            'created_at',
            'updated_at',
            'status',
            'reason',
            'level'
        ]);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }


}
