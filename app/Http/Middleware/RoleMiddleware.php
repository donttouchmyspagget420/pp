<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request,  Closure $next, string $roles): Response
    {
        $roles = explode(',', $roles);
        foreach ($roles as $rol) {
            if (!$request->user()->hasRole($rol)) {
                return redirect()->route('home')->with('error', 'No tiene bastante permisos');
            }
        }

        return $next($request);
    }
}
