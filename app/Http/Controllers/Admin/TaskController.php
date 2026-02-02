<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $tasks = Task::withCount('assignments')->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $users = User::where('status', 'approved')->where('kyc_verified', true)->get();
        
        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'reward_points' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        Task::create($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $task = Task::findOrFail($id);
        $users = User::where('status', 'approved')->where('kyc_verified', true)->get();
        
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'reward_points' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        Task::findOrFail($id)->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function assignToUser(Request $request, $id, $userId)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        TaskAssignment::create([
            'task_id' => $id,
            'user_id' => $userId,
            'assigned_at' => now()
        ]);

        return back()->with('success', 'Task assigned to user successfully!');
    }
}