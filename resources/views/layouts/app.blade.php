<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Saint Paul’s Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="font-bold text-lg">Saint Paul’s Academy</a>
            @auth
                <div>
                    <span class="mr-4">{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf

                    <a href="{{ route('dashboard') }}" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Dashboard
                    </a>

                        <button class="bg-red-500 px-3 py-1 rounded">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
