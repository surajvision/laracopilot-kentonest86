@extends('layouts.admin')

@section('title', 'KYC Verification Management')
@section('page-title', 'KYC Verification')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">KYC Submissions</h3>
            <div class="flex space-x-2">
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Pending: {{ $kycs->where('status', 'pending')->count() }}</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Approved: {{ $kycs->where('status', 'approved')->count() }}</span>
                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">Rejected: {{ $kycs->where('status', 'rejected')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Documents</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Submitted</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($kycs as $kyc)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $kyc->user->name }}</p>
                                <p class="text-sm text-gray-500">ID: #{{ $kyc->user->id }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <p class="text-gray-800">{{ $kyc->user->email }}</p>
                                <p class="text-gray-500">{{ $kyc->user->phone }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="text-green-600">3 documents uploaded</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $kyc->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($kyc->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($kyc->status === 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($kyc->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.kyc.show', $kyc->id) }}" class="text-blue-600 hover:underline text-sm">Review Documents</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t">
        {{ $kycs->links() }}
    </div>
</div>
@endsection
