<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale');

        if (!in_array($locale, ['en', 'id'])) {
            $locale = config('app.fallback_locale');
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        return $next($request);
    }
}
