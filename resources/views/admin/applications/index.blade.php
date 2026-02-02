@extends('layouts.admin')

@section('title', 'Applications Management')
@section('page-title', 'Applications')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">All Applications</h3>
            <div class="flex space-x-2">
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Pending: {{ $applications->where('status', 'pending')->count() }}</span>
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Approved: {{ $applications->where('status', 'approved')->count() }}</span>
                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">Rejected: {{ $applications->where('status', 'rejected')->count() }}</span>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applicant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Education</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Experience</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email Verified</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($applications as $app)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $app->full_name }}</p>
                                <p class="text-sm text-gray-500">{{ $app->city }}, {{ $app->country }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm">
                                <p class="text-gray-800">{{ $app->email }}</p>
                                <p class="text-gray-500">{{ $app->phone }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $app->education }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $app->experience_years }} years</td>
                        <td class="px-6 py-4">
                            @if($app->email_verified)
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">✓ Verified</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">✗ Not Verified</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($app->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($app->status === 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.applications.show', $app->id) }}" class="text-blue-600 hover:underline text-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t">
        {{ $applications->links() }}
    </div>
</div>
@endsection
