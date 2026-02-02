<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use Illuminate\Http\Request;

class JobRequestController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $jobRequests = JobRequest::with(['user', 'task'])->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.job-requests.index', compact('jobRequests'));
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $jobRequest = JobRequest::with(['user', 'task'])->findOrFail($id);
        
        return view('admin.job-requests.show', compact('jobRequest'));
    }

    public function assignNumber(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'unique_number' => 'required|string|unique:job_requests,unique_number'
        ]);

        $jobRequest = JobRequest::findOrFail($id);
        $jobRequest->unique_number = $validated['unique_number'];
        $jobRequest->number_assigned_at = now();
        $jobRequest->save();

        return back()->with('success', 'Unique number assigned successfully!');
    }

    public function approve($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $jobRequest = JobRequest::findOrFail($id);
        $jobRequest->status = 'approved';
        $jobRequest->approved_at = now();
        $jobRequest->save();

        return redirect()->route('admin.job-requests.index')->with('success', 'Job request approved!');
    }

    public function reject($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $jobRequest = JobRequest::findOrFail($id);
        $jobRequest->status = 'rejected';
        $jobRequest->rejected_at = now();
        $jobRequest->save();

        return redirect()->route('admin.job-requests.index')->with('success', 'Job request rejected.');
    }
}