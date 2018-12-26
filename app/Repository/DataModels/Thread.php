<?php

namespace App\Repository\DataModels;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * The attributes that are mass assignable.
     * @author Yansen
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'forum_id',
        'content',
        'created_at',
        'updated_at',
    ];

    /**
     * Thread relation: Many Threads belongs to one User
     * @author Yansen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Thread relation: Many Threads belongs to one Forum
     * @author Yansen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
