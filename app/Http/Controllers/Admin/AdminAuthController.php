<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)
            ->where('active', true)
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Update last login
            $admin->update(['last_login_at' => now()]);

            // Set session
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_email' => $admin->email,
                'admin_role' => $admin->role,
            ]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back, ' . $admin->name . '!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials or account is inactive.',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        session()->forget([
            'admin_logged_in',
            'admin_id',
            'admin_name',
            'admin_email',
            'admin_role'
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'Logged out successfully.');
    }
}