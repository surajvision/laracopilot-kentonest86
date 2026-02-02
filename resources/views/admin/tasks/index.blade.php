@extends('layouts.admin')

@section('title', 'Tasks Management')
@section('page-title', 'Tasks')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.tasks.create') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition inline-block">+ Create New Task</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <h3 class="text-lg font-bold text-gray-800">All Tasks</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Task Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reward Points</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned Users</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($tasks as $task)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $task->title }}</p>
                                <p class="text-sm text-gray-500">{{ Str::limit($task->description, 60) }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">{{ $task->reward_points }} pts</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            {{ $task->assignments->count() }} users
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($task->status === 'active') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.tasks.edit', $task->id) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <a href="{{ route('admin.tasks.assign', $task->id) }}" class="text-purple-600 hover:underline text-sm">Assign Users</a>
                            <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm" onclick="return confirm('Delete this task?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
