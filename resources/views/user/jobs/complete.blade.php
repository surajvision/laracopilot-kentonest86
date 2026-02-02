@extends('layouts.user')

@section('title', 'Mark Job as Completed')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Mark Job as Completed</h1>
            <p class="text-gray-600">{{ $jobRequest->task->title }}</p>
            <p class="text-sm text-purple-600 mt-1">Job Number: {{ $jobRequest->unique_number }}</p>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <p class="text-sm text-blue-800">📝 Please provide details about your completed work and upload proof if required.</p>
        </div>

        <form action="{{ route('user.jobs.complete.store', $jobRequest->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Completion Notes *</label>
                    <p class="text-sm text-gray-600 mb-2">Describe what you accomplished and any relevant details</p>
                    <textarea name="completion_notes" rows="5" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('completion_notes') border-red-500 @enderror" required>{{ old('completion_notes') }}</textarea>
                    @error('completion_notes')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Upload Proof of Completion (Optional)</label>
                    <p class="text-sm text-gray-600 mb-2">Upload screenshots, documents, or files showing your completed work</p>
                    <input type="file" name="completion_proof" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('completion_proof') border-red-500 @enderror" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.zip">
                    @error('completion_proof')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    <p class="text-xs text-gray-500 mt-1">Accepted formats: JPG, PNG, PDF, DOC, DOCX, ZIP (max 10MB)</p>
                </div>

                <div class="bg-gray-50 p-4 rounded">
                    <label class="flex items-start">
                        <input type="checkbox" name="confirm_completion" class="mt-1 mr-3 w-4 h-4 text-purple-600" required>
                        <span class="text-sm text-gray-700">I confirm that I have completed this task according to the requirements and all information provided is accurate.</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('user.jobs.show', $jobRequest->id) }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">Cancel</a>
                <button type="submit" class="bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-3 rounded-lg font-semibold hover:from-green-700 hover:to-green-800 transition">✓ Mark as Completed</button>
            </div>
        </form>
    </div>
</div>
@endsection
