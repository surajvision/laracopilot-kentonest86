@extends('layouts.user')

@section('title', 'Job Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $jobRequest->task->title }}</h1>
                <p class="text-gray-600 mt-2">Job Request #{{ $jobRequest->id }}</p>
            </div>
            <div class="text-right">
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($jobRequest->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($jobRequest->status === 'approved') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst($jobRequest->status) }}
                </span>
                <p class="text-sm text-gray-600 mt-2">Reward: <span class="font-bold text-purple-600">{{ $jobRequest->task->reward_points }} points</span></p>
            </div>
        </div>

        @if($jobRequest->unique_number)
            <div class="bg-purple-50 border-l-4 border-purple-500 p-4 mb-6">
                <p class="text-sm font-semibold text-purple-800">Your Unique Job Number:</p>
                <p class="text-2xl font-mono font-bold text-purple-900 mt-1">{{ $jobRequest->unique_number }}</p>
            </div>
        @endif

        <div class="border-t pt-6 mb-6">
            <h3 class="font-bold text-gray-800 text-lg mb-3">Task Description</h3>
            <p class="text-gray-700">{{ $jobRequest->task->description }}</p>
        </div>

        @if($jobRequest->task->requirements)
            <div class="border-t pt-6 mb-6">
                <h3 class="font-bold text-gray-800 text-lg mb-3">Requirements</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-gray-700">{{ $jobRequest->task->requirements }}</p>
                </div>
            </div>
        @endif

        <div class="border-t pt-6 mb-6">
            <h3 class="font-bold text-gray-800 text-lg mb-3">Your Evaluation Answers</h3>
            <div class="space-y-4">
                @php $answers = $jobRequest->evaluation_answers; @endphp
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm font-semibold text-gray-700 mb-1">Question 1: Why are you interested in this task?</p>
                    <p class="text-gray-800">{{ $answers['evaluation_q1'] ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm font-semibold text-gray-700 mb-1">Question 2: What relevant experience do you have?</p>
                    <p class="text-gray-800">{{ $answers['evaluation_q2'] ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm font-semibold text-gray-700 mb-1">Question 3: How will you approach this task?</p>
                    <p class="text-gray-800">{{ $answers['evaluation_q3'] ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm font-semibold text-gray-700 mb-1">Question 4: What challenges do you anticipate?</p>
                    <p class="text-gray-800">{{ $answers['evaluation_q4'] ?? 'N/A' }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm font-semibold text-gray-700 mb-1">Question 5: How long will it take you to complete?</p>
                    <p class="text-gray-800">{{ $answers['evaluation_q5'] ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="border-t pt-6">
            <h3 class="font-bold text-gray-800 text-lg mb-3">Status Timeline</h3>
            <div class="space-y-2 text-sm">
                <p><span class="text-gray-500">Requested:</span> {{ $jobRequest->created_at->format('F d, Y g:i A') }}</p>
                @if($jobRequest->status === 'approved')
                    <p><span class="text-gray-500">Approved:</span> {{ $jobRequest->approved_at?->format('F d, Y g:i A') ?? 'Recently' }}</p>
                @endif
                @if($jobRequest->completion_status === 'completed')
                    <p><span class="text-gray-500">Completed:</span> {{ $jobRequest->completed_at->format('F d, Y g:i A') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('user.jobs') }}" class="text-purple-600 hover:underline">← Back to My Jobs</a>
        @if($jobRequest->status === 'approved' && $jobRequest->completion_status !== 'completed')
            <a href="{{ route('user.jobs.complete', $jobRequest->id) }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold">Mark as Completed</a>
        @endif
    </div>
</div>
@endsection
