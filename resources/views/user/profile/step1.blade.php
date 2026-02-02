@extends('layouts.user')

@section('title', 'Complete Profile - Step 1')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Complete Your Profile</h1>
            <p class="text-gray-600">Step 1 of 3: Basic Information</p>
            <div class="mt-4 flex space-x-2">
                <div class="flex-1 h-2 bg-purple-600 rounded"></div>
                <div class="flex-1 h-2 bg-gray-200 rounded"></div>
                <div class="flex-1 h-2 bg-gray-200 rounded"></div>
            </div>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <p class="text-sm text-blue-800">📝 Please complete your profile to access tasks and start earning rewards.</p>
        </div>

        <form action="{{ route('user.profile.step1.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('name') border-red-500 @enderror" required>
                    @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded-lg px-4 py-3 bg-gray-100" readonly>
                        <p class="text-xs text-gray-500 mt-1">Email cannot be changed</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Phone Number *</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('phone') border-red-500 @enderror" required>
                        @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Date of Birth *</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('date_of_birth') border-red-500 @enderror" required>
                    @error('date_of_birth')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Gender *</label>
                    <select name="gender" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('gender') border-red-500 @enderror" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition">Next Step →</button>
            </div>
        </form>
    </div>
</div>
@endsection
