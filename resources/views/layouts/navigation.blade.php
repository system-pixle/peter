<nav class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-8">
                <a href="/" class="text-xl font-bold text-blue-600">CBC System</a>

                @auth
                    {{-- Director Links --}}
                    @if (Auth::user()->role === 'director')
                        <a href="{{ route('director.dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('teachers.index') }}" class="nav-link">Teachers</a>
                        <a href="{{ route('admins.index') }}" class="nav-link">Admins</a>
                        <a href="{{ route('students.index') }}" class="nav-link">Students</a>
                        <a href="{{ route('reports.index') }}" class="nav-link">Reports</a>
                    @endif

                    {{-- Admin Links --}}
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('students.index') }}" class="nav-link">Students</a>
                        <a href="{{ route('fees.index') }}" class="nav-link">Fees</a>
                        <a href="{{ route('reports.index') }}" class="nav-link">Reports</a>
                    @endif

                    {{-- Teacher Links --}}
                    @if (Auth::user()->role === 'teacher')
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('attendance.index') }}" class="nav-link">Attendance</a>
                        <a href="#">Grades (coming soon)</a>
                    @endif
                @endauth
            </div>

            {{-- Right section: user info --}}
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-600">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Add some shared styling --}}
<style>
.nav-link {
    color: #4a5568;
    text-decoration: none;
    font-weight: 500;
}
.nav-link:hover {
    color: #2563eb;
}
</style>
