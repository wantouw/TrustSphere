<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login_page()
    {
        return view('login-page');
    }
    public function register_page()
    {
        return view('register-page');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users,name|max:40',
            'email' => 'required|unique:users,email|email',
            'bio' => 'string|max:500',
            'dob' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->toDateString(),
            ],
            'profile_picture' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ], [
            'dob.before_or_equal' => 'You must be at least 18 years old.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->password = bcrypt($request->password);

        if ($request->has('bio')) {
            $user->bio = $request->bio;
        }
        $user->save();

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $customName = $user->id . '.' . $image->getClientOriginalExtension();
            $filePath = $image->storeAs('images/profile_pictures', $customName, 'public');
            $user->profile_picture = 'images/profile_pictures/' . $customName;
            $user->save();
        }

        $user->save();

        return redirect()->route('login_page')->with('success', 'Registration successful!');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('login');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
