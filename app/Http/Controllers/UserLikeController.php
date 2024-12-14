<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\UserLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLikeController extends Controller
{
    //
    public function liked_projects_page()
    {
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
            ->whereNotIn('role_id', function ($query) {
                $query->select('id')
                    ->from('roles')
                    ->where('name', '=', 'admin');
            })
            ->where('id', '!=', $currentUserId)
            ->get();
        $projects = Auth::user()->liked_projects;
        return view('liked-projects-page', compact('projects', 'suggested_users', 'trending_categories'));
    }
    public function like_project(Request $request)
    {
        $user_id = Auth::id();
        $validated = $request->validate([
            'project_id' => 'required'
        ]);
        $project_id = $validated['project_id'];
        $has_liked = UserLike::where('project_id', $project_id)->where('user_id', $user_id)->exists();
        if($has_liked)
        {
            UserLike::where('project_id', $project_id)->where('user_id', $user_id)->delete();
            return redirect()->back()->with('success', 'Project Unliked!');
        }

        UserLike::create([
            'project_id' => $project_id,
            'user_id' => $user_id
        ]);
        return redirect()->back()->with('success', 'Project Liked!');


    }
}
