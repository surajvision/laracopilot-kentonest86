<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - TaskFlow Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-900 via-indigo-900 to-blue-900 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">User Login</h1>
                <p class="text-gray-600 mt-2">Welcome back to TaskFlow Pro</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" required autofocus>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition mt-6">Login to Dashboard</button>
            </form>

            <div class="mt-6 text-center space-y-2">
                <p class="text-sm text-gray-600">Don't have an account? <a href="{{ route('apply.step1') }}" class="text-purple-600 hover:underline font-semibold">Apply Now</a></p>
                <a href="{{ route('home') }}" class="text-purple-600 hover:underline text-sm block">← Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
