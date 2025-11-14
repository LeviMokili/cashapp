<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'name' => 'required|string',
        'password' => 'required',
    ]);

    // Check if user exists and is active
    $user = \App\Models\User::where('name', $credentials['name'])->first();

    if (!$user || $user->status !== 'Active') {  // or $user->status != 1
        return back()->with('error', 'Your account is inactive. Please contact admin.');
    }

    // Attempt login
    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        \Log::info('User logged in: ' . $user->name);
        \Log::info('User role: ' . $user->role);

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isUser1()) {
            return redirect()->route('hr.leave.employee.page');
        } elseif ($user->isUser2()) {
            return redirect()->route('DataConfirmation.dashboard');
        }
    }

    return back()->with('error', 'Invalid credentials');
}




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flash('success', 'You have been logged out successfully!');
        return redirect('/');
    }
}
