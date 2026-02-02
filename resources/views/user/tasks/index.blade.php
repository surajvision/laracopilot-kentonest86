@extends('layouts.user')

@section('title', 'Available Tasks')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Available Tasks</h1>
    <p class="text-gray-600 mt-2">Browse and request tasks to start earning rewards</p>
</div>

@if(!$kycApproved)
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 mb-6 rounded-lg">
        <div class="flex items-start">
            <div class="text-3xl mr-4">🔒</div>
            <div>
                <h3 class="font-bold text-yellow-800 text-lg mb-2">KYC Verification Required</h3>
                <p class="text-yellow-700">You must complete KYC verification before requesting tasks.</p>
                @if(!$kycSubmitted)
                    <a href="{{ route('user.kyc.create') }}" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition inline-block mt-3">Submit KYC Documents</a>
                @else
                    <p class="text-yellow-600 mt-2">Your KYC is pending review. Please wait for approval.</p>
                @endif
            </div>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($tasks as $task)
        <div class="bg-white rounded-lg shadow hover:shadow-xl transition p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $task->title }}</h3>
                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">{{ $task->reward_points }} pts</span>
            </div>
            <p class="text-gray-600 mb-4">{{ Str::limit($task->description, 120) }}</p>
            @if($task->requirements)
                <div class="bg-gray-50 p-3 rounded mb-4">
                    <p class="text-xs font-semibold text-gray-700 mb-1">Requirements:</p>
                    <p class="text-sm text-gray-600">{{ Str::limit($task->requirements, 80) }}</p>
                </div>
            @endif
            <div class="flex justify-between items-center mt-4">
                <span class="text-xs text-gray-500">{{ $task->assignments->count() }} users assigned</span>
                <a href="{{ route('user.tasks.show', $task->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition text-sm font-semibold">View Details</a>
            </div>
        </div>
    @endforeach
</div>

@if($tasks->isEmpty())
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <div class="text-6xl mb-4">📭</div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">No Tasks Available</h3>
        <p class="text-gray-600">Check back later for new tasks and opportunities</p>
    </div>
@endif

<div class="mt-8">
    {{ $tasks->links() }}
</div>
@endsection
