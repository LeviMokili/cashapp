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
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        \Log::info('User logged in: ' . $user->name);
        \Log::info('User role: ' . $user->role);

        if ($user->isAdmin()) {
            \Log::info('Redirecting admin to dashboard');
            return redirect()->route('admin.dashboard');
        } elseif ($user->isUser1()) {
            \Log::info('Redirecting user1 to dashboard');
            return redirect()->route('hr.leave.employee.page');
        } elseif ($user->isUser2()) {
            \Log::info('Redirecting user2 to dashboard');
            return redirect()->route('DataConfirmation.dashboard');
        }
    }

    session()->flash('error', 'Invalid credentials');
    return back();
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
