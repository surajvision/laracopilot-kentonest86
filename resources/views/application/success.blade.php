@extends('layouts.app')

@section('title', 'Application Submitted Successfully')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="text-6xl mb-6">✅</div>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Application Submitted Successfully!</h1>
        <p class="text-gray-600 mb-6">Thank you for applying to TaskFlow Pro. We have received your application and will review it shortly.</p>
        
        <div class="bg-purple-50 border-l-4 border-purple-600 p-6 mb-8 text-left">
            <h3 class="font-bold text-lg mb-3">📧 Important: Verify Your Email</h3>
            <p class="text-gray-700 mb-2">We've sent a verification email to your registered email address. Please check your inbox and click the verification link to complete your application.</p>
            <p class="text-sm text-gray-600">Note: Check your spam/junk folder if you don't see the email within a few minutes.</p>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 mb-8 text-left">
            <h3 class="font-bold text-lg mb-3">🔍 What Happens Next?</h3>
            <ol class="list-decimal list-inside space-y-2 text-gray-700">
                <li>Verify your email address using the link we sent you</li>
                <li>Our admin team will review your application within 24-48 hours</li>
                <li>You'll receive an email notification once your application is approved</li>
                <li>After approval, you can login and complete your profile</li>
                <li>Submit KYC documents for verification</li>
                <li>Start working on assigned tasks and earning rewards!</li>
            </ol>
        </div>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('home') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">Return Home</a>
            <a href="{{ route('user.login') }}" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition">Login (After Approval)</a>
        </div>
    </div>
</div>
@endsection
