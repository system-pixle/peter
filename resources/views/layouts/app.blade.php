<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <div class="text-lg font-semibold">St. Paul School System</div>
        <div>
            <a href="{{ route('dashboard') }}" class="mx-2 hover:underline">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="mx-2 hover:underline">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="mx-2 hover:underline">Logout</button>
            </form>
        </div>
    </nav>

    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <footer class="bg-gray-200 text-center py-3 text-sm text-gray-600">
        © {{ date('Y') }} St. Paul School Management System
    </footer>
</body>
</html>
