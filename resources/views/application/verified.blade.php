@extends('layouts.app')

@section('title', 'Email Verified Successfully')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="text-6xl mb-6">✉️</div>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Email Verified Successfully!</h1>
        <p class="text-gray-600 mb-8">Your email has been verified. Your application is now pending admin approval.</p>
        
        <div class="bg-green-50 border-l-4 border-green-600 p-6 mb-8 text-left">
            <h3 class="font-bold text-lg mb-3">✅ Verification Complete</h3>
            <p class="text-gray-700">Your application will be reviewed by our admin team within 24-48 hours. You'll receive an email notification once it's approved.</p>
        </div>

        <a href="{{ route('home') }}" class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition inline-block">Return Home</a>
    </div>
</div>
@endsection
