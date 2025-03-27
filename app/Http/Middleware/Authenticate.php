<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

   /* protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = ['web'];
        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::shouldUse($guard);
            }
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }*/

}
