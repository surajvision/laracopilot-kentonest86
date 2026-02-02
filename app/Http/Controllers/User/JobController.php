<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobRequest;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $user = User::find(session('user_id'));
        
        if (!$user->kyc_verified) {
            return redirect()->route('user.dashboard')->with('error', 'Please complete KYC verification first.');
        }

        $jobs = JobRequest::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('completion_status', '!=', 'completed')
            ->with('task')
            ->get();
        
        return view('user.jobs', compact('jobs'));
    }

    public function show($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $userId = session('user_id');
        $job = JobRequest::where('id', $id)
            ->where('user_id', $userId)
            ->with('task')
            ->firstOrFail();
        
        return view('user.job-detail', compact('job'));
    }

    public function complete(Request $request, $id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $validated = $request->validate([
            'completion_notes' => 'required|string',
            'completion_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240'
        ]);

        $userId = session('user_id');
        $job = JobRequest::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $proofPath = null;
        if ($request->hasFile('completion_proof')) {
            $file = $request->file('completion_proof');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $proofPath = $file->storeAs('job-proofs', $fileName, 'public');
        }

        $job->update([
            'completion_status' => 'completed',
            'completion_notes' => $validated['completion_notes'],
            'completion_proof_path' => $proofPath,
            'completed_at' => now()
        ]);

        return redirect()->route('user.jobs.completed')->with('success', 'Job marked as completed!');
    }

    public function completed()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $user = User::find(session('user_id'));
        
        $completedJobs = JobRequest::where('user_id', $user->id)
            ->where('completion_status', 'completed')
            ->with('task')
            ->orderBy('completed_at', 'desc')
            ->get();
        
        return view('user.jobs-completed', compact('completedJobs'));
    }
}