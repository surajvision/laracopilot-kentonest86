<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TaskFlow Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-700 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">TaskFlow Admin</h1>
            <p class="text-gray-600">Sign in to access the admin panel</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    placeholder="admin@taskflow.com"
                    required
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-800 transition-all duration-300 shadow-lg"
            >
                Sign In
            </button>
        </form>

        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
            <p class="text-sm font-semibold text-gray-700 mb-2">Test Credentials:</p>
            <div class="space-y-1 text-sm text-gray-600">
                <p><strong>Admin:</strong> admin@taskflow.com / admin123</p>
                <p><strong>Manager:</strong> manager@taskflow.com / manager123</p>
                <p><strong>Supervisor:</strong> supervisor@taskflow.com / supervisor123</p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                ← Back to Homepage
            </a>
        </div>
    </div>

    <div class="absolute bottom-4 text-center w-full">
        <p class="text-white text-sm">
            Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="underline hover:text-gray-200">LaraCopilot</a>
        </p>
    </div>
</body>
</html>
