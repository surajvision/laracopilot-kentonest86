@extends('layouts.app')

@section('title', 'Application Step 1 - Personal Information')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Application Form</h1>
            <p class="text-gray-600">Step 1 of 3: Personal Information</p>
            <div class="mt-4 flex space-x-2">
                <div class="flex-1 h-2 bg-purple-600 rounded"></div>
                <div class="flex-1 h-2 bg-gray-200 rounded"></div>
                <div class="flex-1 h-2 bg-gray-200 rounded"></div>
            </div>
        </div>

        <form action="{{ route('apply.step1.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Full Name *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('full_name') border-red-500 @enderror" required>
                    @error('full_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('email') border-red-500 @enderror" required>
                        @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Phone Number *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('phone') border-red-500 @enderror" required>
                        @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Date of Birth *</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('date_of_birth') border-red-500 @enderror" required>
                    @error('date_of_birth')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('home') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">Cancel</a>
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition">Next Step →</button>
            </div>
        </form>
    </div>
</div>
@endsection
