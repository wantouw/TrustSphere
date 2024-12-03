<?php

namespace App\Http\Controllers;

use App\Models\UserLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLikeController extends Controller
{
    //
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
