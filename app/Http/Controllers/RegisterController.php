<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function register_page(){
        return view('register-page');
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:users,name|max:40',
            'email' => 'required|unique:users,email|email',
            'bio' => 'required|string|max:500',
            'dob' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->toDateString(),
            ],
            'profile_picture' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ],[
            'dob.before_or_equal' => 'You must be at least 18 years old.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->password = bcrypt($request->password);

        if($request->has('bio')){
            $user->bio = $request->bio;
        }
        $user->save();

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $customName = $user->id . '.' . $image->getClientOriginalExtension();
            $filePath = $image->storeAs('images/profile_pictures', $customName, 'public');
            $user->profile_picture = $customName;
            $user->save();
        }

        $user->save();

        return redirect()->route('login_page')->with('success', 'Registration successful!');

    }
}
