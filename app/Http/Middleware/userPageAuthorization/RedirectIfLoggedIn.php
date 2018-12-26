<?php

namespace App\Http\Middleware\userPageAuthorization;

use Closure;

class RedirectIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(authUserDomain() == null)
            abort(404, 'Page not found');

        return $next($request);
    }
}
