<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'mobile' => 'required|numeric|digits:10', // Assuming mobile is 10 digits
            'password' => 'required|min:8|confirmed',
            'state' => 'required|string|max:255',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error_type', 'register');
        }

        // If validation passes, continue with registration logic
        // For now, just dump the request data
        $inputs = $request->all();
        unset($inputs['_token']);
        $inputs['password'] = bcrypt($inputs['password']);
        $user = User::create($inputs);
        Auth::login($user);
        session()->flash('success', 'Your Registration Success.');
        return back();
    }

    public function login(Request $request)
    {
        // Step 1: Validate the input fields
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Step 2: If validation fails, redirect back with errors and open the login modal
        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error_type', 'login');
        }

        // Step 3: Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = false;

        if (Auth::attempt($credentials)) {
            // Step 4: If authentication is successful, redirect to the intended page or dashboard
            $request->session()->regenerate();
            return back()->with('success', 'You are successfully logged in!');
        }

        // Step 5: If authentication fails, redirect back with an error message and open the login modal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->with('error_type', 'login');
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation
        $request->session()->regenerateToken();

        // Redirect to the home or login page with a success message
        return back()->with('status', 'Successfully logged out.');
    }
}
