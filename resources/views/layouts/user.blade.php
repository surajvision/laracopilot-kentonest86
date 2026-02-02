<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard - TaskFlow Pro')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .nav-link { @apply px-4 py-2 rounded-lg hover:bg-purple-100 transition-all duration-200; }
        .nav-link.active { @apply bg-purple-600 text-white; }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">TaskFlow Pro</h1>
                    <p class="text-sm text-purple-200">Welcome, {{ session('user_name') }}</p>
                </div>
                <div class="flex space-x-4 items-center">
                    <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : 'text-white' }}">Dashboard</a>
                    <a href="{{ route('user.tasks') }}" class="nav-link {{ request()->routeIs('user.tasks*') ? 'active' : 'text-white' }}">Tasks</a>
                    <a href="{{ route('user.jobs') }}" class="nav-link {{ request()->routeIs('user.jobs*') ? 'active' : 'text-white' }}">My Jobs</a>
                    <a href="{{ route('user.jobs.completed') }}" class="nav-link {{ request()->routeIs('user.jobs.completed') ? 'active' : 'text-white' }}">Completed</a>
                    <form action="{{ route('user.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-white">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center">
            <p class="text-sm">© {{ date('Y') }} TaskFlow Pro. All rights reserved.</p>
            <p class="text-sm mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>