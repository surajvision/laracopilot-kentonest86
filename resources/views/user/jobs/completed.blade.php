@extends('layouts.user')

@section('title', 'Completed Jobs')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Completed Jobs</h1>
    <p class="text-gray-600 mt-2">View your completed tasks and earned rewards</p>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="text-center">
            <p class="text-gray-500 text-sm font-semibold">Total Completed</p>
            <p class="text-4xl font-bold text-green-600">{{ $completedJobs->count() }}</p>
        </div>
        <div class="text-center">
            <p class="text-gray-500 text-sm font-semibold">Total Points Earned</p>
            <p class="text-4xl font-bold text-purple-600">{{ $totalPointsEarned }}</p>
        </div>
        <div class="text-center">
            <p class="text-gray-500 text-sm font-semibold">Success Rate</p>
            <p class="text-4xl font-bold text-blue-600">{{ $totalJobs > 0 ? round(($completedJobs->count() / $totalJobs) * 100, 1) : 0 }}%</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <h3 class="text-lg font-bold text-gray-800">Completed Tasks</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Task</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unique Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Points Earned</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Completed Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($completedJobs as $job)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $job->task->title }}</p>
                                <p class="text-sm text-gray-500">{{ Str::limit($job->task->description, 50) }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-mono bg-gray-100 px-3 py-1 rounded text-sm">{{ $job->unique_number }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">+{{ $job->task->reward_points }} pts</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $job->completed_at->format('M d, Y g:i A') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('user.jobs.show', $job->id) }}" class="text-blue-600 hover:underline text-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($completedJobs->isEmpty())
        <div class="p-12 text-center">
            <div class="text-6xl mb-4">🎯</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No Completed Jobs Yet</h3>
            <p class="text-gray-600 mb-4">Complete your first task to start earning rewards</p>
            <a href="{{ route('user.tasks') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition inline-block">Browse Tasks</a>
        </div>
    @endif
</div>

<div class="mt-6">
    {{ $completedJobs->links() }}
</div>
@endsection
