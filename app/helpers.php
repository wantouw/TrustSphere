<?php

use Illuminate\Support\Facades\App;

if (!function_exists('localized_route')) {
    function localized_route($name, $parameters = [], $absolute = true)
    {
        $locale = App::getLocale();

        $parameters = array_merge(['locale' => $locale], $parameters);

        return route($name, $parameters, $absolute);
    }
}
