@extends('layouts.admin')

@section('title', 'Create Task')
@section('page-title', 'Create New Task')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <form action="{{ route('admin.tasks.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Task Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('title') border-red-500 @enderror" required>
                @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description *</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Requirements</label>
                <textarea name="requirements" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('requirements') border-red-500 @enderror">{{ old('requirements') }}</textarea>
                @error('requirements')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Reward Points *</label>
                <input type="number" name="reward_points" value="{{ old('reward_points') }}" min="0" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('reward_points') border-red-500 @enderror" required>
                @error('reward_points')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Status *</label>
                <select name="status" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('status') border-red-500 @enderror" required>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.tasks.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition">Cancel</a>
            <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">Create Task</button>
        </div>
    </form>
</div>
@endsection
