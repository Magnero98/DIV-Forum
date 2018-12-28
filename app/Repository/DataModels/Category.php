<?php

namespace App\Repository\DataModels;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     * @author Alvent
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    ];

    /**
    * Create eloquent, 1 Category is in many forums
    * @author Alvent 
    */
    
    public function forums(){
    	return $this->hasMany('App\Repository\DataModels\Forum');
    }
}
