<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function home_page()
    {
        $projects = Project::all();
        $trending_categories = Category::withCount(['projects' => function ($query) {
            $query->where('projects.created_at', '>=', now()->subMonth());
        }])
            ->orderBy('projects_count', 'desc')
            ->take(10)
            ->get();
        $currentUserId = Auth::id();
        $suggested_users = User::whereNotIn('id', function ($query) use ($currentUserId) {
            $query->select('friend_id')
                ->from('friends')
                ->where('user_id', $currentUserId);
        })
            ->where('id', '!=', $currentUserId)
            ->get();
        return view('home-page', compact('projects', 'trending_categories','suggested_users'));
    }
}
