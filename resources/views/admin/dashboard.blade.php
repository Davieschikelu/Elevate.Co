<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Elevate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-50 font-[Inter]">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white p-8">
            <div class="text-2xl font-bold tracking-tight text-white mb-12">ELEVATE. <span
                    class="text-xs bg-indigo-600 px-2 py-1 rounded">ADMIN</span></div>
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-3 rounded-lg bg-indigo-600 font-semibold transition">Dashboard</a>
                <a href="{{ route('admin.users') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">Manage
                    Users</a>
                <a href="{{ route('admin.logs') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">System
                    Logs</a>
                <a href="{{ route('admin.templates') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">Templates</a>
            </nav>
            <div class="mt-auto pt-12">
                <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-white text-sm">Return to Site</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-12">
            <h1 class="text-3xl font-bold text-slate-800 mb-8">Admin Overview</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-500 text-sm font-semibold uppercase mb-2">Total Users</p>
                    <p class="text-4xl font-bold text-slate-800">{{ $stats['users_count'] }}</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-500 text-sm font-semibold uppercase mb-2">Resumes Generated</p>
                    <p class="text-4xl font-bold text-slate-800">{{ $stats['resumes_count'] }}</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-500 text-sm font-semibold uppercase mb-2">System Status</p>
                    <p class="text-lg font-bold text-green-600 flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                        Operational
                    </p>
                </div>
            </div>

            <h2 class="text-xl font-bold text-slate-700 mb-6">Recent Users</h2>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">User</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Email</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Joined</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($stats['recent_users'] as $user)
                            <tr>
                                <td class="px-6 py-4 text-slate-800 font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-bold rounded {{ $user->isAdmin() ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>