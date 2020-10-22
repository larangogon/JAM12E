<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserStatus
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @param Closure $next
     * @return void
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user != null) {
            if ($user->active) {
                return $next($request);
            } else {
                Auth::logout() ;

                return redirect('login');
            }
        } else {
            return $next($request);
        }
    }
}
