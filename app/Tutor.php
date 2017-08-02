<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Tutor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'tutor';
    protected $table = 'tutors';

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
        return $this->hasMany('App\Availability');
    }

    public function appointments()
    {
        return $this->hasManyThrough(Appointment::class, Availability::class);
    }
}

