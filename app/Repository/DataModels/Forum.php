<?php

namespace App\Repository\DataModels;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    /**
     * The attributes that are mass assignable.
     * @author Alvent
     *
     * @var array
     */
    protected $fillable = [
    	'user_id',
    	'category_id',
    	'forum_status_id',
    	'title',
    ];

    /**
    * Create eloquent, Each forum is belongs to 1 category
    * @author Alvent 
    */

    public function category(){
        return $this->belongsTo('App\Repository\DataModels\Category');
    }

    /**
    * Create eloquent, Each forum is belongs to 1 forum status
    * @author Alvent 
    */

    public function forum_status(){
        return $this->belongsTo('App\Repository\DataModels\Forum_Status');
    }

    /**
    * Create eloquent, Each forum is belongs to 1 user
    * @author Alvent 
    */
    public function user(){
        return $this->belongsTo('App\Repository\DataModels\User');
    }
}
