@extends('layouts.admin')

@section('title', 'Application Details')
@section('page-title', 'Application Details')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $application->full_name }}</h3>
            <p class="text-gray-600">Application ID: #{{ $application->id }}</p>
        </div>
        <span class="px-4 py-2 rounded-full text-sm font-semibold
            @if($application->status === 'pending') bg-yellow-100 text-yellow-800
            @elseif($application->status === 'approved') bg-green-100 text-green-800
            @else bg-red-100 text-red-800 @endif">
            {{ ucfirst($application->status) }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h4 class="font-bold text-gray-700 mb-4">Personal Information</h4>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-semibold">{{ $application->email }}</p>
                    @if($application->email_verified)
                        <span class="text-xs text-green-600">✓ Email Verified</span>
                    @else
                        <span class="text-xs text-red-600">✗ Email Not Verified</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-semibold">{{ $application->phone }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date of Birth</p>
                    <p class="font-semibold">{{ $application->date_of_birth->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <div>
            <h4 class="font-bold text-gray-700 mb-4">Address Information</h4>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Full Address</p>
                    <p class="font-semibold">{{ $application->address }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">City, State</p>
                    <p class="font-semibold">{{ $application->city }}, {{ $application->state }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">ZIP Code, Country</p>
                    <p class="font-semibold">{{ $application->zip_code }}, {{ $application->country }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t pt-6 mb-6">
        <h4 class="font-bold text-gray-700 mb-4">Professional Information</h4>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-sm text-gray-500">Education</p>
                <p class="font-semibold">{{ $application->education }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Occupation</p>
                <p class="font-semibold">{{ $application->occupation }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Experience</p>
                <p class="font-semibold">{{ $application->experience_years }} years</p>
            </div>
        </div>
    </div>

    <div class="border-t pt-6 mb-6">
        <h4 class="font-bold text-gray-700 mb-3">Why Join TaskFlow Pro?</h4>
        <p class="text-gray-800 bg-gray-50 p-4 rounded">{{ $application->why_join }}</p>
    </div>

    <div class="border-t pt-6">
        <h4 class="font-bold text-gray-700 mb-3">Application Timeline</h4>
        <div class="space-y-2 text-sm">
            <p><span class="text-gray-500">Submitted:</span> {{ $application->created_at->format('F d, Y g:i A') }}</p>
            @if($application->email_verified_at)
                <p><span class="text-gray-500">Email Verified:</span> {{ $application->email_verified_at->format('F d, Y g:i A') }}</p>
            @endif
            @if($application->approved_at)
                <p><span class="text-gray-500">Approved:</span> {{ $application->approved_at->format('F d, Y g:i A') }}</p>
            @endif
            @if($application->rejected_at)
                <p><span class="text-gray-500">Rejected:</span> {{ $application->rejected_at->format('F d, Y g:i A') }}</p>
            @endif
        </div>
    </div>
</div>

@if($application->status === 'pending' && $application->email_verified)
    <div class="bg-white rounded-lg shadow p-6">
        <h4 class="font-bold text-gray-700 mb-4">Actions</h4>
        <div class="flex space-x-4">
            <form action="{{ route('admin.applications.approve', $application->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition" onclick="return confirm('Approve this application? User will be able to login.');">✓ Approve Application</button>
            </form>
            <form action="{{ route('admin.applications.reject', $application->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Reject this application?');">✗ Reject Application</button>
            </form>
        </div>
    </div>
@endif

<div class="mt-6">
    <a href="{{ route('admin.applications.index') }}" class="text-purple-600 hover:underline">← Back to Applications</a>
</div>
@endsection
