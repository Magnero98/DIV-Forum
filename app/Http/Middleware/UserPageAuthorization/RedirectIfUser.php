<?php

namespace App\Http\Middleware\userPageAuthorization;

use App\Domains\DomainModels\UserRoleEnumeration;
use Closure;

class RedirectIfUser
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
        if(authUserDomain()->getRoleId() != userRole())
            abort(404, 'Page not found');

        return $next($request);
    }
}
