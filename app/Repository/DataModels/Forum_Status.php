<?php

namespace App\Repository\DataModels;

use Illuminate\Database\Eloquent\Model;

class Forum_Status extends Model
{
    public $table = "forum_status";
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
    * Create eloquent, Each forum_status is in many forums
    * @author Alvent 
    */

    public function forums(){
        return $this->hasMany('App\Repository\DataModels\Forum');
    }
}
