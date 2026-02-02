@extends('layouts.admin')

@section('title', 'Assign Task to Users')
@section('page-title', 'Assign Task: ' . $task->title)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Task Details</h3>
        <p class="text-gray-600">{{ $task->description }}</p>
        <p class="text-sm text-purple-600 mt-2">Reward: {{ $task->reward_points }} points</p>
    </div>

    <form action="{{ route('admin.tasks.assign.store', $task->id) }}" method="POST">
        @csrf
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-3">Select Users to Assign *</label>
            <div class="border rounded-lg p-4 max-h-96 overflow-y-auto space-y-2">
                @foreach($users as $user)
                    <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" 
                            {{ in_array($user->id, $assignedUserIds) ? 'checked' : '' }}
                            class="mr-3 w-4 h-4 text-purple-600">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        @if(in_array($user->id, $assignedUserIds))
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Already Assigned</span>
                        @endif
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.tasks.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition">Cancel</a>
            <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">Update Assignments</button>
        </div>
    </form>
</div>
@endsection
