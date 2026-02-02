<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\JobRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
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

        $assignedTaskIds = TaskAssignment::where('user_id', $user->id)->pluck('task_id');
        $tasks = Task::whereIn('id', $assignedTaskIds)->where('status', 'active')->get();
        
        return view('user.tasks', compact('tasks'));
    }

    public function show($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $user = User::find(session('user_id'));
        
        if (!$user->kyc_verified) {
            return redirect()->route('user.dashboard')->with('error', 'Please complete KYC verification first.');
        }

        $task = Task::findOrFail($id);
        
        $assignment = TaskAssignment::where('user_id', $user->id)
            ->where('task_id', $id)
            ->first();

        if (!$assignment) {
            return redirect()->route('user.tasks')->with('error', 'Task not assigned to you.');
        }

        $existingRequest = JobRequest::where('user_id', $user->id)
            ->where('task_id', $id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();
        
        return view('user.task-detail', compact('task', 'existingRequest'));
    }

    public function submitRequest(Request $request, $id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $validated = $request->validate([
            'evaluation_q1' => 'required|string',
            'evaluation_q2' => 'required|string',
            'evaluation_q3' => 'required|string',
            'evaluation_q4' => 'required|string',
            'evaluation_q5' => 'required|string'
        ]);

        $userId = session('user_id');

        $existingRequest = JobRequest::where('user_id', $userId)
            ->where('task_id', $id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'You already have a pending/approved request for this task.');
        }

        JobRequest::create([
            'user_id' => $userId,
            'task_id' => $id,
            'evaluation_answers' => json_encode($validated),
            'status' => 'pending'
        ]);

        return redirect()->route('user.tasks')->with('success', 'Evaluation submitted! Awaiting admin to assign unique number.');
    }
}