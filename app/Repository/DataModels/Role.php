<?php

namespace App\Repository\DataModels;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     * @author Yansen
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Role relation: One Role has many users
     * @author Yansen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
