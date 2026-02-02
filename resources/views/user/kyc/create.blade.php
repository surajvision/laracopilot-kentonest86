@extends('layouts.user')

@section('title', 'Submit KYC Documents')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">KYC Verification</h1>
            <p class="text-gray-600">Submit your identity documents for verification</p>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <h3 class="font-semibold text-blue-800 mb-2">Important Information</h3>
            <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
                <li>Please upload clear, readable copies of your ID documents</li>
                <li>Accepted formats: JPG, PNG, PDF (max 5MB per file)</li>
                <li>All 3 documents are required for verification</li>
                <li>Documents will be reviewed within 24-48 hours</li>
            </ul>
        </div>

        <form action="{{ route('user.kyc.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">ID Proof Document 1 *</label>
                    <p class="text-sm text-gray-600 mb-2">Upload your government-issued ID (Passport, Driver's License, National ID)</p>
                    <input type="file" name="id_proof_1" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('id_proof_1') border-red-500 @enderror" required accept=".jpg,.jpeg,.png,.pdf">
                    @error('id_proof_1')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">ID Proof Document 2 *</label>
                    <p class="text-sm text-gray-600 mb-2">Upload proof of address (Utility Bill, Bank Statement, Rental Agreement)</p>
                    <input type="file" name="id_proof_2" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('id_proof_2') border-red-500 @enderror" required accept=".jpg,.jpeg,.png,.pdf">
                    @error('id_proof_2')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">ID Proof Document 3 *</label>
                    <p class="text-sm text-gray-600 mb-2">Upload a selfie holding your ID document (for identity verification)</p>
                    <input type="file" name="id_proof_3" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 @error('id_proof_3') border-red-500 @enderror" required accept=".jpg,.jpeg,.png,.pdf">
                    @error('id_proof_3')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="bg-gray-50 p-4 rounded">
                    <label class="flex items-start">
                        <input type="checkbox" name="accept_terms" class="mt-1 mr-3 w-4 h-4 text-purple-600" required>
                        <span class="text-sm text-gray-700">I certify that all documents provided are authentic and belong to me. I understand that providing false information may result in account suspension.</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('user.dashboard') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">Cancel</a>
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition">Submit KYC Documents</button>
            </div>
        </form>
    </div>
</div>
@endsection
