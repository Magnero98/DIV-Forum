<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\DomainModels\UserDomainModel;
use App\Domains\DomainModels\MessageDomainModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class MessageController extends Controller
{
    /**
     * Display the specified message according to user id.
     * @author Alvent
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = UserDomainModel::getAuthUser();
        if($user){
            $messages = MessageDomainModel::showMessage(10, $user->getId());
            return view('messages.index', ["messages" => $messages]);
        }

        return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     * @author Alvent
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()){
            return back()->withErrors($validator)->withInput(Input::all());
        }

        MessageDomainModel::createMessageFromArray($request->all());

        return back();
    }

    /**
     * Get a validator for creating message.
     * @author Alvent
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data){
        return Validator::make($data, [
            'receiver_id' => 'required',
            'content' => 'required',
        ]);
    }


    /**
     * Remove the specified message from db.
     * @author Alvent
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MessageDomainModel::deleteMessage($id);
        return back();
    }
}
