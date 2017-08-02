<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function availabilities()
    {
        return $this->belongsToMany(Availability::class, 'appointments', 'user_id', 'availability_id')->withPivot([
            'created_at',
            'updated_at',
            'status'
        ]);
    }

    public function appointments()
    {
        return $this->hasManyThrough(Appointment::class);
    }


}
