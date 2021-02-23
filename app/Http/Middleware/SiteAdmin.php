<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class SiteAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->isSiteAdmin($request)) {
            throw new AuthorizationException('You must be a site administrator to view this page.');
        }

        return $next($request);
    }

    /**
     * Checks if the authenticated user is a site administrator.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    protected function isSiteAdmin(Request $request)
    {
        return $request->user() && $request->user()->is_admin;
    }
}
