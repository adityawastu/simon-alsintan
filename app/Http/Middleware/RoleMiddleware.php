<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $u = $request->user();
        if (!$u || !in_array($u->role, $roles, true)) {
            abort(403, 'Anda tidak punya akses.');
        }
        return $next($request);
    }
}
