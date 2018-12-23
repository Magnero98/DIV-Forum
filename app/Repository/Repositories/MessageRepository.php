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
     * Retrieve all data from Database with pagination default perpage = 10
     * @author Alvent
     *
     * @param Integer $perPage = 10
     * @return Collection of Repository/DataModels/Message
     */
    public function all($perPage = 10)
    {
        // TODO: Implement all() method.
    }

    /**
     * Retrieve data from Database with specified id
     * @author Alvent
     *
     * @return Repository/DataModels/Message
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Insert new model to Database
     * @author Alvent
     *
     * @param DomainModel $model
     * @return Repository/DataModels/Message
     */
    public function create(DomainModel $model)
    {
        // TODO: Implement create() method.
    }

    /**
     * Update data with specified id inside Database with updated model
     * @author Alvent
     *
     * @param DomainModel $model
     * @param Integer $id
     * @return Boolean
     */
    public function update(DomainModel $model, $id)
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
    public static function delete($id)
    {
        $message = Message::find($id); 
        $message->delete();
    }


      /**
     * Get all message from specified user id
     * @author Alvent
     *
     * @param Integer $id
     * @return Boolean
     */
    public static function showMessage($id){
    	$messages = User::find($id)->messages;
    	return $messages;
    }

}