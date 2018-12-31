<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/22/2018
 * Time: 9:44 AM
 */

namespace App\Repository\Repositories;
use App\Repository\DataModels\Message;
use App\Repository\DataModels\User;
use App\Domains\DomainModels\DomainModel;

class MessageRepository implements Repository
{

    /**
     * Retrieve all message received with pagination default perpage = 10
     * @author Alvent
     * @param Integer $perPage = 10
     * @param Integer $id
     * @return Collection of Illuminate\Database\Eloquent\Model
     */
    public function all($perPage = 10, $id)
    {
        $messages = Message::where('receiver_id','=',$id)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
        return $messages;
    }

    /**
     * Retrieve data from Database with specified id
     * @author Alvent
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Insert message from array data to Database
     * @author Alvent
     *
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $message = new Message();
        $message->sender_id = $data['sender_id'];
        $message->receiver_id = $data['receiver_id']; 
        $message->content = $data['content']; 
        $message->created_at = date('Y-m-d H:i:s');
        $message->updated_at = date('Y-m-d H:i:s');

        $message->save();
    }

    /**
     * Update data with specified id inside Database with updated model
     * @author Alvent
     *
     * @param array $data
     * @return Boolean
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete data with specified id inside Database
     * @author Alvent
     *
     * @param Integer $id
     * @return Boolean
     */
    public function delete($id)
    {
        $message = Message::find($id); 
        $message->delete();
    }

}