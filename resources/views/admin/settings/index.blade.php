@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'System Settings')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-4">General Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Site Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'TaskFlow Pro' }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Admin Email</label>
                        <input type="email" name="admin_email" value="{{ $settings['admin_email'] ?? '' }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Support Email</label>
                        <input type="email" name="support_email" value="{{ $settings['support_email'] ?? '' }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Support Phone</label>
                        <input type="text" name="support_phone" value="{{ $settings['support_phone'] ?? '' }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Points & Rewards Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Points Per Dollar</label>
                        <input type="number" name="points_per_dollar" value="{{ $settings['points_per_dollar'] ?? '100' }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Minimum Payout Amount ($)</label>
                        <input type="number" name="minimum_payout" value="{{ $settings['minimum_payout'] ?? '50' }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Application Settings</h3>
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="application_approval_auto" value="true" {{ ($settings['application_approval_auto'] ?? 'false') === 'true' ? 'checked' : '' }} class="mr-3 w-4 h-4 text-purple-600">
                            <span class="text-gray-700 font-semibold">Auto-approve applications</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="kyc_required" value="true" {{ ($settings['kyc_required'] ?? 'true') === 'true' ? 'checked' : '' }} class="mr-3 w-4 h-4 text-purple-600">
                            <span class="text-gray-700 font-semibold">Require KYC verification</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition">Save Settings</button>
        </div>
    </form>
</div>
@endsection
