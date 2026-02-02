<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email.']);
        }

        if ($user->status !== 'approved') {
            return back()->withErrors(['email' => 'Your application is still pending admin approval.']);
        }

        session([
            'user_logged_in' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);

        if (!$user->profile_completed) {
            return redirect()->route('user.profile.step1');
        }

        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        session()->forget(['user_logged_in', 'user_id', 'user_name', 'user_email']);
        return redirect()->route('user.login');
    }
}