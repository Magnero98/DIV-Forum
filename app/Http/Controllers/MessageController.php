<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\DomainModels\UserDomainModel;
use App\Domains\DomainModels\MessageDomainModel;

class MessageController extends Controller
{

	/**
	* Show all message received from current user, return to home if user dont login yet
	* @author Alvent
	*/
    public function showMessage(){
    	$user = UserDomainModel::getAuthUser();
    	if($user){
    		$messages = MessageDomainModel::showMessage($user->getId());
    		return view('inbox', ["messages" => $messages]);
    	}

    	return redirect('home');
    }

    /**
    * delete message with specified id
    * @author Alvent 
    * @param Integer $id
    */

    public function deleteMessage($id){
        MessageDomainModel::deleteMessage($id);

        return back();
    }
}
