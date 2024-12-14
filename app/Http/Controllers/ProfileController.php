<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //

    public function my_profile_page()
    {
        $user = Auth::user();

        return view('my-profile-page', compact('user'));
    }

    public function user_profile_page($user_id)
    {
        $user = User::with('projects')->find($user_id);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('user-profile-page', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
        // if (!$user) {
        //     abort(404, 'User not found');
        // }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? null;

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('my_profile_page')->with('success', 'Profile updated successfully!');
    }
}
