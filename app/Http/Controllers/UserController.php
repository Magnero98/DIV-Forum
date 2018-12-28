<?php

namespace App\Http\Controllers;

use App\Domains\DomainModels\UserDomainModel;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * UserDomainModel Constructor
     * @author Yansen
     */
    public function __construct()
    {
        $this->middleware(
            'validateUserData',
            ['only' => ['store', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserDomainModel::getAllUsers(5);

        return view('users.index')
            ->with('users', $users);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        UserDomainModel::addUser($request->all());

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserDomainModel::findUser($id);
        return view('users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = UserDomainModel::findUser($id);
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        UserDomainModel::editUser($request->all(), $id);

        if(authUserDomain()->getRoleId() == memberRole())
            return redirect(route('users.show', ['id' => authUserDomain()->getId()]));
        else if(authUserDomain()->getRoleId() == adminRole())
            return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserDomainModel::deleteUser($id);

        return back();
    }
}
