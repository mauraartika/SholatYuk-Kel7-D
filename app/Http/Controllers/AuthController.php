<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Handle Registration Submission
    public function register(Request $request)
    {
        // 🌟 TEMPORARY DEBUG CODE: Add this block right here
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    // if ($validator->fails()) {
    //     dd($validator->errors()->all()); // This halts execution and prints the exact error!
    // }
    // 🌟 END OF DEBUG CODE
        // 1. Validate the forms inputs (including matching passwords)
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'in:laki-laki,perempuan'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Checks for password_confirmation
        ]);

        // 2. Create the User in your SQLite database
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'gender' => $credentials['gender'],
            'password' => Hash::make($credentials['password']), // Securely hash password
        ]);

        // 3. Log the user in and redirect to dashboard
        Auth::login($user);

        return redirect()->intended('/home');
    }

   // Handle Login Submission
public function login(Request $request)
{
    // 1. Validate inputs
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // 2. Check if the "Remember Me" checkbox was ticked
    // $request->boolean('remember') automatically returns true if checked, false if not.
    $remember = $request->boolean('remember');

    // 3. Attempt to authenticate the user (passing $remember as the 2nd argument)
    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();

        return redirect()->intended('/home');
    }

    // 4. Return back with an error if authentication fails
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
}


    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
