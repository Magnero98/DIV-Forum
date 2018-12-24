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
}
