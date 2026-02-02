@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Welcome back, {{ session('user_name') }}! 👋</h1>
    <p class="text-gray-600 mt-2">Here's your performance overview</p>
</div>

@if(!$kycSubmitted)
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 mb-6 rounded-lg">
        <div class="flex items-start">
            <div class="text-3xl mr-4">⚠️</div>
            <div class="flex-1">
                <h3 class="font-bold text-yellow-800 text-lg mb-2">KYC Verification Required</h3>
                <p class="text-yellow-700 mb-3">Please submit your KYC documents to access all tasks and start earning rewards.</p>
                <a href="{{ route('user.kyc.create') }}" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition inline-block">Submit KYC Documents</a>
            </div>
        </div>
    </div>
@elseif($kycPending)
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-6 rounded-lg">
        <div class="flex items-start">
            <div class="text-3xl mr-4">⏳</div>
            <div>
                <h3 class="font-bold text-blue-800 text-lg mb-2">KYC Verification Pending</h3>
                <p class="text-blue-700">Your KYC documents are under review. You'll be notified once approved.</p>
            </div>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Points</p>
                <p class="text-3xl font-bold text-purple-600">{{ $totalPoints }}</p>
            </div>
            <div class="text-4xl">⭐</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Assigned Tasks</p>
                <p class="text-3xl font-bold text-blue-600">{{ $assignedTasks }}</p>
            </div>
            <div class="text-4xl">📋</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Active Jobs</p>
                <p class="text-3xl font-bold text-green-600">{{ $activeJobs }}</p>
            </div>
            <div class="text-4xl">✅</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Completed</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $completedJobs }}</p>
            </div>
            <div class="text-4xl">🎉</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-bold text-gray-800">Available Tasks</h3>
        </div>
        <div class="p-6">
            @if($availableTasks->count() > 0)
                <div class="space-y-4">
                    @foreach($availableTasks->take(3) as $task)
                        <div class="border-b pb-3">
                            <h4 class="font-semibold text-gray-800">{{ $task->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($task->description, 80) }}</p>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm text-purple-600 font-semibold">{{ $task->reward_points }} points</span>
                                <a href="{{ route('user.tasks.show', $task->id) }}" class="text-blue-600 hover:underline text-sm">View Details →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('user.tasks') }}" class="block text-center text-purple-600 hover:underline mt-4 font-semibold">View All Tasks →</a>
            @else
                <p class="text-gray-500 text-center py-4">No tasks available at the moment</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
        </div>
        <div class="p-6">
            @if($recentJobs->count() > 0)
                <div class="space-y-4">
                    @foreach($recentJobs as $job)
                        <div class="border-b pb-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $job->task->title }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $job->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    @if($job->completion_status === 'completed') bg-green-100 text-green-800
                                    @elseif($job->completion_status === 'in_progress') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $job->completion_status)) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No recent activity</p>
            @endif
        </div>
    </div>
</div>
@endsection
