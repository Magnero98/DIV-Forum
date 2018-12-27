<?php

namespace App\Http\Middleware\Thread;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ValidateThreadData
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
            'content' => 'required'
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
                $route = route('threads.create');
            else if($request->route()->getActionMethod() == 'update')
                $route = route('threads.edit', ['id' => $request->route('thread')]);

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
