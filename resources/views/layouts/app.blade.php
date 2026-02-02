<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaskFlow Pro - Professional Task Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-primary { @apply bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 shadow-lg; }
        .card { @apply bg-white rounded-lg shadow-md p-6 transition-all duration-300 hover:shadow-xl; }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="gradient-bg text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold">TaskFlow Pro</a>
                <div class="flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-purple-200 transition">Home</a>
                    <a href="{{ route('apply.step1') }}" class="hover:text-purple-200 transition">Apply Now</a>
                    <a href="{{ route('user.login') }}" class="hover:text-purple-200 transition">Login</a>
                    <a href="{{ route('admin.login') }}" class="hover:text-purple-200 transition">Admin</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">TaskFlow Pro</h3>
                <p class="text-gray-400">Professional task management platform connecting skilled workers with opportunities worldwide.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('apply.step1') }}" class="hover:text-white transition">Apply Now</a></li>
                    <li><a href="{{ route('user.login') }}" class="hover:text-white transition">User Login</a></li>
                    <li><a href="{{ route('admin.login') }}" class="hover:text-white transition">Admin Login</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Support</h4>
                <ul class="space-y-2 text-gray-400">
                    <li>Email: support@taskflow.com</li>
                    <li>Phone: +1-800-TASKFLOW</li>
                    <li>Hours: 24/7 Support</li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 py-6 text-center text-sm">
            <p>© {{ date('Y') }} TaskFlow Pro. All rights reserved.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
