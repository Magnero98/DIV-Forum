<?php

namespace App;

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
}
