@extends('layouts.user')

@section('title', 'Complete Profile - Step 3')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Complete Your Profile</h1>
            <p class="text-gray-600">Step 3 of 3: Professional Information</p>
            <div class="mt-4 flex space-x-2">
                <div class="flex-1 h-2 bg-purple-600 rounded"></div>
                <div class="flex-1 h-2 bg-purple-600 rounded"></div>
                <div class="flex-1 h-2 bg-purple-600 rounded"></div>
            </div>
        </div>

        <form action="{{ route('user.profile.step3.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Highest Education *</label>
                        <select name="education" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('education') border-red-500 @enderror" required>
                            <option value="">Select Education Level</option>
                            <option value="High School" {{ old('education', $user->education) === 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="Associate Degree" {{ old('education', $user->education) === 'Associate Degree' ? 'selected' : '' }}>Associate Degree</option>
                            <option value="Bachelor's Degree" {{ old('education', $user->education) === "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                            <option value="Master's Degree" {{ old('education', $user->education) === "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                            <option value="PhD" {{ old('education', $user->education) === 'PhD' ? 'selected' : '' }}>PhD</option>
                        </select>
                        @error('education')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Current Occupation *</label>
                        <input type="text" name="occupation" value="{{ old('occupation', $user->occupation) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('occupation') border-red-500 @enderror" required>
                        @error('occupation')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Years of Experience *</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $user->experience_years) }}" min="0" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('experience_years') border-red-500 @enderror" required>
                    @error('experience_years')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Skills (comma separated)</label>
                    <input type="text" name="skills" value="{{ old('skills', $user->skills) }}" placeholder="e.g., Data Entry, Content Writing, Research" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('skills') border-red-500 @enderror">
                    @error('skills')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Bio / About You</label>
                    <textarea name="bio" rows="4" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('bio') border-red-500 @enderror" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('user.profile.step2') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">← Previous</a>
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition">Complete Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
