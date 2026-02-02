@extends('layouts.user')

@section('title', $task->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $task->title }}</h1>
                <p class="text-gray-600 mt-2">{{ $task->assignments->count() }} users assigned</p>
            </div>
            <span class="px-6 py-3 bg-purple-100 text-purple-800 rounded-full text-lg font-bold">{{ $task->reward_points }} points</span>
        </div>

        <div class="border-t pt-6 mb-6">
            <h3 class="font-bold text-gray-800 text-lg mb-3">Task Description</h3>
            <p class="text-gray-700 leading-relaxed">{{ $task->description }}</p>
        </div>

        @if($task->requirements)
            <div class="border-t pt-6 mb-6">
                <h3 class="font-bold text-gray-800 text-lg mb-3">Requirements</h3>
                <div class="bg-blue-50 p-4 rounded">
                    <p class="text-gray-700">{{ $task->requirements }}</p>
                </div>
            </div>
        @endif

        @if($alreadyRequested)
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded">
                <div class="flex items-start">
                    <div class="text-3xl mr-4">⏳</div>
                    <div>
                        <h3 class="font-bold text-yellow-800 text-lg mb-2">Request Pending</h3>
                        <p class="text-yellow-700">You have already requested this task. Please wait for admin approval.</p>
                        <p class="text-sm text-yellow-600 mt-2">Status: <span class="font-semibold">{{ ucfirst($existingRequest->status) }}</span></p>
                    </div>
                </div>
            </div>
        @elseif(!$kycApproved)
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded">
                <div class="flex items-start">
                    <div class="text-3xl mr-4">🔒</div>
                    <div>
                        <h3 class="font-bold text-red-800 text-lg mb-2">KYC Verification Required</h3>
                        <p class="text-red-700">Please complete KYC verification before requesting tasks.</p>
                        @if(!$kycSubmitted)
                            <a href="{{ route('user.kyc.create') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition inline-block mt-3">Submit KYC Documents</a>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="border-t pt-6">
                <h3 class="font-bold text-gray-800 text-lg mb-4">Request This Task</h3>
                <p class="text-gray-600 mb-4">Please answer the following evaluation questions to request this task:</p>
                
                <form action="{{ route('user.jobs.request', $task->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">1. Why are you interested in this task? *</label>
                            <textarea name="evaluation_q1" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('evaluation_q1') border-red-500 @enderror" required>{{ old('evaluation_q1') }}</textarea>
                            @error('evaluation_q1')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">2. What relevant experience do you have? *</label>
                            <textarea name="evaluation_q2" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('evaluation_q2') border-red-500 @enderror" required>{{ old('evaluation_q2') }}</textarea>
                            @error('evaluation_q2')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">3. How will you approach this task? *</label>
                            <textarea name="evaluation_q3" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('evaluation_q3') border-red-500 @enderror" required>{{ old('evaluation_q3') }}</textarea>
                            @error('evaluation_q3')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">4. What challenges do you anticipate? *</label>
                            <textarea name="evaluation_q4" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('evaluation_q4') border-red-500 @enderror" required>{{ old('evaluation_q4') }}</textarea>
                            @error('evaluation_q4')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">5. How long will it take you to complete? *</label>
                            <textarea name="evaluation_q5" rows="2" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('evaluation_q5') border-red-500 @enderror" required>{{ old('evaluation_q5') }}</textarea>
                            @error('evaluation_q5')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('user.tasks') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">Cancel</a>
                        <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition">Submit Request</button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <a href="{{ route('user.tasks') }}" class="text-purple-600 hover:underline">← Back to Tasks</a>
</div>
@endsection
