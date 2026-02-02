<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kyc;
use App\Models\TaskAssignment;
use App\Models\JobRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $user = User::find(session('user_id'));
        
        if (!$user->profile_completed) {
            return redirect()->route('user.profile.step1');
        }

        $kyc = Kyc::where('user_id', $user->id)->first();
        $kycStatus = $kyc ? $kyc->status : 'not_submitted';
        
        $assignedTasks = TaskAssignment::where('user_id', $user->id)->count();
        $pendingRequests = JobRequest::where('user_id', $user->id)->where('status', 'pending')->count();
        $approvedRequests = JobRequest::where('user_id', $user->id)->where('status', 'approved')->count();
        $completedJobs = JobRequest::where('user_id', $user->id)->where('status', 'completed')->count();
        
        $recentActivity = JobRequest::where('user_id', $user->id)
            ->with('task')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('user.dashboard', compact(
            'user', 'kycStatus', 'assignedTasks', 'pendingRequests', 
            'approvedRequests', 'completedJobs', 'recentActivity'
        ));
    }
}