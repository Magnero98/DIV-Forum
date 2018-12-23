<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\DomainModels\UserDomainModel;
use App\Domains\DomainModels\MessageDomainModel;

class MessageController extends Controller
{
    public function showMessage(){
    	$id = UserDomainModel::getAuthUser();
    	if($id){
    		$messages = MessageDomainModel::showMessage($id->getId());
    		return view('inbox', ["messages" => $messages]);
    	}

    	return redirect('home');
    }
}
