<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Domains\DomainModels\UserDomainModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
     * Get a validator for an incoming registration request.
     * @author Yansen
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|numeric',
            'address' => 'required|regex:(street)',
            'birthday' => 'required|date|before:'
                . (date_format(new DateTime(), 'Y') - 12)
                . '-'
                . date_format(new DateTime(), 'm-d'),
            'gender' => 'required',
            'picture' => 'required|image',
        ]);
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
        $validator = $this->validator($request->all());
        if($validator->fails())
            return redirect(route('users.create'))
                ->withErrors($validator)
                ->withInput(Input::all());

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
        $validator = $this->validator($request->all());
        if($validator->fails())
            return redirect(route('users.edit', ['id' => $id]))
                ->withErrors($validator)
                ->withInput(Input::all());

        UserDomainModel::editUser($request->all(), $id);
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
