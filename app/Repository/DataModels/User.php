<?php

namespace App\Repository\DataModels;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @author Yansen
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'phone',
        'birthday',
        'gender',
        'address',
        'profile_picture',
        'good_popularity',
        'bad_popularity',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function popularities()
    {
        return $this->belongsToMany(
            User::class,
            'popularities',
            'voter_user_id',
            'target_user_id')
            ->withPivot(['popularity_status_id']);
    }

}
