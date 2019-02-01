<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if ( ! empty($roles))
        {
            $userRoles = ( ! empty($request->user())) ? $request->user()->toArray()['roles'] : array();
            $userRoleNameArr = array_column($userRoles, 'name');
            $acceptedUserRoles = array_intersect($userRoleNameArr, $roles);

            if (empty($acceptedUserRoles))
            {
                if ($request->ajax() || $request->wantsJson())
                {
                    return response('Unauthorized.', 401);
                }
                else
                {
                    abort(403);
                }
            }
        }
        return $next($request);
    }
}
