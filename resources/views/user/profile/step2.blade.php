@extends('layouts.user')

@section('title', 'Complete Profile - Step 2')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Complete Your Profile</h1>
            <p class="text-gray-600">Step 2 of 3: Address Information</p>
            <div class="mt-4 flex space-x-2">
                <div class="flex-1 h-2 bg-purple-600 rounded"></div>
                <div class="flex-1 h-2 bg-purple-600 rounded"></div>
                <div class="flex-1 h-2 bg-gray-200 rounded"></div>
            </div>
        </div>

        <form action="{{ route('user.profile.step2.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Street Address *</label>
                    <textarea name="address" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('address') border-red-500 @enderror" required>{{ old('address', $user->address) }}</textarea>
                    @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">City *</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('city') border-red-500 @enderror" required>
                        @error('city')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">State/Province *</label>
                        <input type="text" name="state" value="{{ old('state', $user->state) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('state') border-red-500 @enderror" required>
                        @error('state')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">ZIP/Postal Code *</label>
                        <input type="text" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('zip_code') border-red-500 @enderror" required>
                        @error('zip_code')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Country *</label>
                        <input type="text" name="country" value="{{ old('country', $user->country) }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('country') border-red-500 @enderror" required>
                        @error('country')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('user.profile.step1') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">← Previous</a>
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition">Next Step →</button>
            </div>
        </form>
    </div>
</div>
@endsection
