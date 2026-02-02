@extends('layouts.admin')

@section('title', 'Job Request Details')
@section('page-title', 'Job Request Details')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">Job Request #{{ $jobRequest->id }}</h3>
            <p class="text-gray-600">{{ $jobRequest->user->name }} - {{ $jobRequest->task->title }}</p>
        </div>
        <div class="text-right">
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                @if($jobRequest->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($jobRequest->status === 'approved') bg-green-100 text-green-800
                @else bg-red-100 text-red-800 @endif">
                {{ ucfirst($jobRequest->status) }}
            </span>
            <p class="text-sm text-gray-600 mt-2">{{ $jobRequest->created_at->format('M d, Y g:i A') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h4 class="font-bold text-gray-700 mb-4">User Information</h4>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Name</p>
                    <p class="font-semibold">{{ $jobRequest->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-semibold">{{ $jobRequest->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-semibold">{{ $jobRequest->user->phone }}</p>
                </div>
            </div>
        </div>

        <div>
            <h4 class="font-bold text-gray-700 mb-4">Task Information</h4>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Task Title</p>
                    <p class="font-semibold">{{ $jobRequest->task->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Reward Points</p>
                    <p class="font-semibold text-purple-600">{{ $jobRequest->task->reward_points }} points</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Unique Number</p>
                    @if($jobRequest->unique_number)
                        <p class="font-mono bg-gray-100 px-3 py-1 rounded inline-block">{{ $jobRequest->unique_number }}</p>
                    @else
                        <p class="text-gray-400">Not assigned yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="border-t pt-6 mb-6">
        <h4 class="font-bold text-gray-700 mb-4">Evaluation Answers</h4>
        <div class="bg-gray-50 p-4 rounded space-y-3">
            @php $answers = $jobRequest->evaluation_answers; @endphp
            <div>
                <p class="text-sm font-semibold text-gray-700">Question 1:</p>
                <p class="text-gray-800">{{ $answers['evaluation_q1'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-700">Question 2:</p>
                <p class="text-gray-800">{{ $answers['evaluation_q2'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-700">Question 3:</p>
                <p class="text-gray-800">{{ $answers['evaluation_q3'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-700">Question 4:</p>
                <p class="text-gray-800">{{ $answers['evaluation_q4'] ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-700">Question 5:</p>
                <p class="text-gray-800">{{ $answers['evaluation_q5'] ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    @if($jobRequest->completion_status === 'completed')
        <div class="border-t pt-6">
            <h4 class="font-bold text-gray-700 mb-4">Completion Details</h4>
            <div class="bg-green-50 p-4 rounded">
                <p class="text-sm text-gray-700 mb-2"><strong>Completed At:</strong> {{ $jobRequest->completed_at->format('F d, Y g:i A') }}</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Notes:</strong></p>
                <p class="text-gray-800">{{ $jobRequest->completion_notes }}</p>
                @if($jobRequest->completion_proof_path)
                    <p class="mt-3">
                        <a href="{{ asset('storage/' . $jobRequest->completion_proof_path) }}" target="_blank" class="text-blue-600 hover:underline text-sm">View Completion Proof →</a>
                    </p>
                @endif
            </div>
        </div>
    @endif
</div>

@if($jobRequest->status === 'pending')
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h4 class="font-bold text-gray-700 mb-4">Assign Unique Number</h4>
        <form action="{{ route('admin.job-requests.assign-number', $jobRequest->id) }}" method="POST" class="flex items-end space-x-4">
            @csrf
            <div class="flex-1">
                <label class="block text-gray-700 font-semibold mb-2">Unique Job Number *</label>
                <input type="text" name="unique_number" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" placeholder="e.g., JOB-2024-001" required>
            </div>
            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">Assign Number & Approve</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h4 class="font-bold text-gray-700 mb-4">Or Reject Request</h4>
        <form action="{{ route('admin.job-requests.reject', $jobRequest->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Reject this job request?');">✗ Reject Request</button>
        </form>
    </div>
@endif

<div class="mt-6">
    <a href="{{ route('admin.job-requests.index') }}" class="text-purple-600 hover:underline">← Back to Job Requests</a>
</div>
@endsection
