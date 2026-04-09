<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission): Application|RedirectResponse|Redirector
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        if (!$request->user()->can($permission)) {
            abort(403);
        }

        return $next($request);
    }
}
