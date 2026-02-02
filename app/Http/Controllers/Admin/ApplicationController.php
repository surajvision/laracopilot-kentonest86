<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $applications = Application::orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.applications.index', compact('applications'));
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $application = Application::findOrFail($id);
        
        return view('admin.applications.show', compact('application'));
    }

    public function approve($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $application = Application::findOrFail($id);
        $application->status = 'approved';
        $application->approved_at = now();
        $application->save();

        User::create([
            'name' => $application->full_name,
            'email' => $application->email,
            'phone' => $application->phone,
            'password' => bcrypt(Str::random(10)),
            'application_id' => $application->id,
            'status' => 'approved',
            'profile_completed' => false
        ]);

        return redirect()->route('admin.applications.index')->with('success', 'Application approved successfully! User can now login.');
    }

    public function reject($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $application = Application::findOrFail($id);
        $application->status = 'rejected';
        $application->rejected_at = now();
        $application->save();

        return redirect()->route('admin.applications.index')->with('success', 'Application rejected.');
    }
}