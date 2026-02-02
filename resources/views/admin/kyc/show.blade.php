@extends('layouts.admin')

@section('title', 'KYC Review')
@section('page-title', 'KYC Document Review')

@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h3 class="text-2xl font-bold text-gray-800">{{ $kyc->user->name }}</h3>
            <p class="text-gray-600">User ID: #{{ $kyc->user->id }} | KYC ID: #{{ $kyc->id }}</p>
        </div>
        <span class="px-4 py-2 rounded-full text-sm font-semibold
            @if($kyc->status === 'pending') bg-yellow-100 text-yellow-800
            @elseif($kyc->status === 'approved') bg-green-100 text-green-800
            @else bg-red-100 text-red-800 @endif">
            {{ ucfirst($kyc->status) }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h4 class="font-bold text-gray-700 mb-4">User Information</h4>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Full Name</p>
                    <p class="font-semibold">{{ $kyc->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-semibold">{{ $kyc->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-semibold">{{ $kyc->user->phone }}</p>
                </div>
            </div>
        </div>

        <div>
            <h4 class="font-bold text-gray-700 mb-4">Submission Details</h4>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Submitted At</p>
                    <p class="font-semibold">{{ $kyc->created_at->format('F d, Y g:i A') }}</p>
                </div>
                @if($kyc->approved_at)
                    <div>
                        <p class="text-sm text-gray-500">Approved At</p>
                        <p class="font-semibold">{{ $kyc->approved_at->format('F d, Y g:i A') }}</p>
                    </div>
                @endif
                @if($kyc->rejected_at)
                    <div>
                        <p class="text-sm text-gray-500">Rejected At</p>
                        <p class="font-semibold">{{ $kyc->rejected_at->format('F d, Y g:i A') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="border-t pt-6">
        <h4 class="font-bold text-gray-700 mb-4">Uploaded Documents</h4>
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
            <p class="text-sm text-blue-800">Note: To view uploaded documents, run: <code class="bg-blue-100 px-2 py-1 rounded">php artisan storage:link</code></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="border rounded-lg p-4">
                <h5 class="font-semibold mb-2">ID Proof Document 1</h5>
                <p class="text-sm text-gray-600 mb-3">{{ $kyc->id_proof_1_name }}</p>
                <a href="{{ asset('storage/' . $kyc->id_proof_1_path) }}" target="_blank" class="text-blue-600 hover:underline text-sm">View Document →</a>
            </div>
            <div class="border rounded-lg p-4">
                <h5 class="font-semibold mb-2">ID Proof Document 2</h5>
                <p class="text-sm text-gray-600 mb-3">{{ $kyc->id_proof_2_name }}</p>
                <a href="{{ asset('storage/' . $kyc->id_proof_2_path) }}" target="_blank" class="text-blue-600 hover:underline text-sm">View Document →</a>
            </div>
            <div class="border rounded-lg p-4">
                <h5 class="font-semibold mb-2">ID Proof Document 3</h5>
                <p class="text-sm text-gray-600 mb-3">{{ $kyc->id_proof_3_name }}</p>
                <a href="{{ asset('storage/' . $kyc->id_proof_3_path) }}" target="_blank" class="text-blue-600 hover:underline text-sm">View Document →</a>
            </div>
        </div>
    </div>
</div>

@if($kyc->status === 'pending')
    <div class="bg-white rounded-lg shadow p-6">
        <h4 class="font-bold text-gray-700 mb-4">Actions</h4>
        <div class="flex space-x-4">
            <form action="{{ route('admin.kyc.approve', $kyc->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition" onclick="return confirm('Approve this KYC submission?');">✓ Approve KYC</button>
            </form>
            <form action="{{ route('admin.kyc.reject', $kyc->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition" onclick="return confirm('Reject this KYC submission?');">✗ Reject KYC</button>
            </form>
        </div>
    </div>
@endif

<div class="mt-6">
    <a href="{{ route('admin.kyc.index') }}" class="text-purple-600 hover:underline">← Back to KYC List</a>
</div>
@endsection
