@extends('layouts.admin')

@section('title', 'Job Requests Management')
@section('page-title', 'Job Requests')

@section('content')
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Task</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unique Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Completion</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($jobRequests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $request->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $request->user->email }}</p>
                            </div>
                        </td>
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
                                <span class="text-gray-400 text-sm">Not assigned</span>
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
                            <span class="px-2 py-1 rounded text-xs
                                @if($request->completion_status === 'completed') bg-green-100 text-green-800
                                @elseif($request->completion_status === 'in_progress') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $request->completion_status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.job-requests.show', $request->id) }}" class="text-blue-600 hover:underline text-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t">
        {{ $jobRequests->links() }}
    </div>
</div>
@endsection
