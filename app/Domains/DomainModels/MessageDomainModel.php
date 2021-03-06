<?php

namespace App\Domains\DomainModels;
use App\Repository\Repositories\MessageRepository;

Class MessageDomainModel extends DomainModel{
	protected $id;
	protected $senderId;
	protected $receiverId;
	protected $content;

	 /**
     * MessageRepository Object
     * @author Alvent
     *
     * @var MessageRepository
     */
    protected $messageRepository;

	 /**
     * Properties GETTER
     * @author Alvent
     */

     public function getId(){ return $this->id; }
     public function getSenderId(){ return $this->senderId; }
     public function getReceiverId(){ return $this->receiverId; }
     public function getContent(){ return $this->content; }

     /**
     * Properties SETTER 
     * @author Alvent 
     */

     protected function setId($id){ $this->id = $id; return $this; }
     protected function setSenderId($senderId){ $this->senderId = $senderId; return $this; }
     protected function setReceiverId($receiverId){ $this->receiverId = $receiverId; return $this; }
     protected function setContent($content){ $this->content = $content; return $this; }
   

    /**
     * MessageDomainModel Constructor
     * @author Alvent
     */
    protected function __construct()
    {
        $this->messageRepository = new MessageRepository();
    }

    /**
     * insert message from array of Data to database
     * @author Alvent
     *
     * @param array $data
     */
     public static function createMessageFromArray(array $data)
    {
        $messageRepository = new MessageRepository();
        $messageRepository->create($data);
    }

	/**
     * Factory Method to create MessageDomainModel from model
     * @author Alvent
     *
     * @param Repository/DataModels/Message $model
     * @return MessageDomainModel
     */
    public static function createMessageFromMessageDataModel(Message $model)
    {

    }

    /**
    * Show all message received from current User
    * @author Alvent
    * @param $id
	* @return  Collection of Repository/DataModels/Message
	*/

    public static function showMessage($perPage, $id){
        $messageRepository = new MessageRepository();
    	$messages = $messageRepository->all($perPage, $id);
    	return $messages;
    }

    /**
    * Delete message from db with specified Id 
    * @author Alvent 
    * @param Integer $id
    */

    public static function deleteMessage($id){
        $messageRepository = new MessageRepository();
        $messageRepository->delete($id);
    }


}





