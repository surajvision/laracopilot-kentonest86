<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Kyc;
use App\Models\Task;
use App\Models\JobRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $approvedApplications = Application::where('status', 'approved')->count();
        
        $totalUsers = User::where('status', 'approved')->count();
        $pendingKyc = Kyc::where('status', 'pending')->count();
        $approvedKyc = Kyc::where('status', 'approved')->count();
        
        $totalTasks = Task::count();
        $activeTasks = Task::where('status', 'active')->count();
        
        $pendingJobRequests = JobRequest::where('status', 'pending')->count();
        $approvedJobRequests = JobRequest::where('status', 'approved')->count();
        
        $recentApplications = Application::orderBy('created_at', 'desc')->limit(5)->get();
        $recentKyc = Kyc::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $recentJobRequests = JobRequest::with(['user', 'task'])->orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalApplications', 'pendingApplications', 'approvedApplications',
            'totalUsers', 'pendingKyc', 'approvedKyc',
            'totalTasks', 'activeTasks',
            'pendingJobRequests', 'approvedJobRequests',
            'recentApplications', 'recentKyc', 'recentJobRequests'
        ));
    }
}