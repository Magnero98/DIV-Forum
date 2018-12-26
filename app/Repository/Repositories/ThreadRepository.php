<?php /** @noinspection PhpUndefinedNamespaceInspection */

/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/25/2018
 * Time: 9:33 PM
 */

namespace App\Repository\Repositories;

use DateTime;
use App\Repository\DataModels\Thread;

class ThreadRepository implements Repository
{
    /**
     * Retrive all threads for specified forum id
     * where thread's content contains the keyword
     * or the thread owner's name contains the keyword
     * and then give the result with pagination
     * and appends the url with keyword parameter
     * @author Yansen
     *
     * @param Integer $forumId
     * @param Integer $perPage = 10
     * @param String $keyword = ''
     * @return Collection of Repository\DataModels\Thread
     */
    public function all($forumId, $perPage = 10, $keyword = '')
    {
        return Thread::where('forum_id', '=', $forumId)
            ->where(function($query) use ($keyword) {
                $query->where('content', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($query) use ($keyword){
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            })->paginate($perPage)
            ->appends(['keyword' => $keyword]);
    }

    /**
     * Retrieve data from Database with specified id
     * @author Yansen
     *
     * @param Integer $id
     * @return Repository\DataModels\Thread
     */
    public function find($id)
    {
        return Thread::find($id);
    }

    /**
     * Insert new model to Database
     * @author Yansen
     *
     * @param array $data
     * @return Repository\DataModels\Thread
     */
    public function create(array $data)
    {
        return Thread::create([
            'user_id' => $data['user_id'],
            'forum_id' => $data['forum_id'],
            'content' => $data['content'],
            'created_at' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'updated_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
        ]);
    }

    /**
     * Update data with specified id inside Database with updated model
     * @author Yansen
     *
     * @param array $data
     * @param Integer $id
     * @return Boolean
     */
    public function update(array $data, $id)
    {
        return Thread::where('id', 'LIKE', $id)
            ->update([
                'content' => $data['content'],
                'updated_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
            ]);
    }

    /**
     * Delete data with specified id inside Database
     * @author Yansen
     *
     * @param Integer $id
     * @return Boolean
     */
    public function delete($id)
    {
        return Thread::destroy($id);
    }

}