<?php

namespace App\Http\Middleware\User;

use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ValidateUserData
{
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
     * Validate the request data.
     * @author Yansen
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function validate(Request $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails())
        {
            $route = "";
            if($request->route()->getActionMethod() == 'store')
                $route = route('users.create');
            else if($request->route()->getActionMethod() == 'update')
                $route = route('users.edit', ['id' => $request->route('user')]);

            return redirect($route)
                ->withErrors($validator)
                ->withInput(Input::all());
        }

        return null;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $this->validate($request);

        if($response != null)
            return $response;

        return $next($request);
    }
}
