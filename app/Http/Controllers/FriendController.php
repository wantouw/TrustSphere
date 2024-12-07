<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //
    public function follow_friends(Request $request)
    {
        $user_id = Auth::id();
        $friend_id = $request->friend_id;
        if (Friend::where('friend_id', $friend_id)->where('user_id', $user_id)->exists()){
            Friend::where('friend_id', $friend_id)->where('user_id', $user_id)->delete();
            Friend::where('friend_id', $user_id)->where('user_id', $friend_id)->delete();
            return redirect()->back()->with('success', 'User followed!');
        }
        Friend::create([
            'user_id' => $user_id,
            'friend_id' => $friend_id
        ]);
        Friend::create([
            'user_id' => $friend_id,
            'friend_id' => $user_id
        ]);


        return redirect()->back()->with('success', 'Friendship request sent!');
    }

    public function friends_page() {
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
        return view('friends-page', compact('suggested_users', 'trending_categories'));
    }
}
