<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class LocaleMiddleware
{
    public function handle($request, Closure $next): mixed
    {
        if (config('locale.status')) {
            if (session()->has('locale') && in_array(session()->get('locale'), array_keys(config('locale.languages')))) {
                app()->setLocale(session()->get('locale'));

                setlocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);

                Carbon::setLocale(config('locale.languages')[session()->get('locale')][0]);

                if (config('locale.languages')[session()->get('locale')][2]) {
                    session(['lang-rtl' => true]);
                } else {
                    session()->forget('lang-rtl');
                }
            }
        }

        return $next($request);
    }
}
