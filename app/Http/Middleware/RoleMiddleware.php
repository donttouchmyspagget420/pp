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
    public function handle(Request $request,  Closure $next, ...$roles): Response
    {
        $i = 0;
        foreach ($roles as $rol) {
            if ($request->user()->hasRole($rol)) {
                $i++;
            }
        }

        if ($i <= 0) {
            return redirect()->route('home')->withErrors(['No tiene bastante permisos']);
        }

        return $next($request);
    }
}
