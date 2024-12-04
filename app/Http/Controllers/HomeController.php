<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home_page(){
        $projects = Project::all();
        return view('home-page', compact('projects'));
    }
}
