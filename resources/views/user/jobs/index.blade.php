@extends('layouts.user')

@section('title', 'My Job Requests')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">My Job Requests</h1>
    <p class="text-gray-600 mt-2">Track your requested and active tasks</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">All Job Requests</h3>
            <div class="flex space-x-2">
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Pending: {{ $jobRequests->where('status', 'pending')->count() }}</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Approved: {{ $jobRequests->where('status', 'approved')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Task</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unique Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Completion</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Requested</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($jobRequests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $request->task->title }}</p>
                                <p class="text-sm text-purple-600">{{ $request->task->reward_points }} points</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($request->unique_number)
                                <span class="font-mono bg-gray-100 px-3 py-1 rounded text-sm">{{ $request->unique_number }}</span>
                            @else
                                <span class="text-gray-400 text-sm">Pending approval</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($request->status === 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($request->completion_status === 'completed') bg-green-100 text-green-800
                                @elseif($request->completion_status === 'in_progress') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $request->completion_status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $request->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('user.jobs.show', $request->id) }}" class="text-blue-600 hover:underline text-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($jobRequests->isEmpty())
        <div class="p-12 text-center">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No Job Requests Yet</h3>
            <p class="text-gray-600 mb-4">Browse available tasks and request one to get started</p>
            <a href="{{ route('user.tasks') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition inline-block">Browse Tasks</a>
        </div>
    @endif
</div>

<div class="mt-6">
    {{ $jobRequests->links() }}
</div>
@endsection
