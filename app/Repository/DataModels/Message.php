<?php

namespace App\Repository\DataModels;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     * @author Alvent
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
    ];
}
