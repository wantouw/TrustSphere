<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function my_profile_page()
    {
        return view('my-profile-page');
    }
}
