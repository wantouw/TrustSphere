<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $locale = Session::get('app_locale');
        if(!$locale) {
            session(['app_locale' => 'en']);
            App::setLocale('en');
        }
        else if (!in_array($locale, ['en', 'id'])) {
            $locale = config('app.fallback_locale');
        }
        else {

            App::setLocale($locale);
        }
        return $next($request);
    }
}
