<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //
    public function change_language(Request $request)
    {
        $lang = $request->query('language', 'en');
        if (in_array($lang, ['en', 'id'])) {
            Session::put('app_locale', $lang);
        }
        return redirect()->back();

    }
}

