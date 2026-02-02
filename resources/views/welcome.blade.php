@extends('layouts.app')

@section('title', 'Welcome to TaskFlow Pro - Professional Task Management Platform')

@section('content')
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Welcome to TaskFlow Pro</h1>
        <p class="text-xl mb-8 text-purple-100">Join thousands of professionals earning money by completing tasks from anywhere in the world</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('apply.step1') }}" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-purple-50 transition shadow-xl">Apply Now</a>
            <a href="{{ route('user.login') }}" class="bg-purple-700 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-purple-800 transition shadow-xl">Member Login</a>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Why Choose TaskFlow Pro?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card text-center">
                <div class="text-5xl mb-4">💼</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Flexible Work</h3>
                <p class="text-gray-600">Work on your own schedule from anywhere. Choose tasks that match your skills and interests.</p>
            </div>
            <div class="card text-center">
                <div class="text-5xl mb-4">💰</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Competitive Rewards</h3>
                <p class="text-gray-600">Earn competitive rewards for every task completed. Get paid for your time and expertise.</p>
            </div>
            <div class="card text-center">
                <div class="text-5xl mb-4">🚀</div>
                <h3 class="text-xl font-bold mb-3 text-gray-800">Career Growth</h3>
                <p class="text-gray-600">Build your portfolio and expand your skills while working on diverse projects.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">How It Works</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-4xl font-bold text-purple-600 mb-3">1</div>
                <h3 class="font-bold text-lg mb-2">Apply</h3>
                <p class="text-gray-600">Complete our simple 3-step application form with your details and qualifications.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-4xl font-bold text-purple-600 mb-3">2</div>
                <h3 class="font-bold text-lg mb-2">Get Approved</h3>
                <p class="text-gray-600">Our team reviews your application and verifies your email within 24-48 hours.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-4xl font-bold text-purple-600 mb-3">3</div>
                <h3 class="font-bold text-lg mb-2">Complete KYC</h3>
                <p class="text-gray-600">Submit your identification documents for verification to access all tasks.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-4xl font-bold text-purple-600 mb-3">4</div>
                <h3 class="font-bold text-lg mb-2">Start Earning</h3>
                <p class="text-gray-600">Browse available tasks, complete them, and start earning rewards immediately.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">What Our Members Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">JD</div>
                    <div class="ml-4">
                        <h4 class="font-bold">John Doe</h4>
                        <p class="text-sm text-gray-500">Marketing Specialist</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">"TaskFlow Pro has been a game-changer for my freelance career. The platform is easy to use and the tasks are always interesting."</p>
            </div>
            <div class="card">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">SM</div>
                    <div class="ml-4">
                        <h4 class="font-bold">Sarah Miller</h4>
                        <p class="text-sm text-gray-500">Graphic Designer</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">"I love the flexibility! I can work whenever I want and the rewards are always fair. Highly recommend to anyone looking for remote work."</p>
            </div>
            <div class="card">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">MJ</div>
                    <div class="ml-4">
                        <h4 class="font-bold">Mike Johnson</h4>
                        <p class="text-sm text-gray-500">Data Analyst</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">"Professional platform with real opportunities. The verification process ensures quality and security for everyone involved."</p>
            </div>
        </div>
    </div>
</section>

<section class="gradient-bg text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Ready to Start Your Journey?</h2>
        <p class="text-xl mb-8 text-purple-100">Join TaskFlow Pro today and unlock unlimited earning potential</p>
        <a href="{{ route('apply.step1') }}" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-purple-50 transition shadow-xl inline-block">Start Your Application</a>
    </div>
</section>
@endsection
