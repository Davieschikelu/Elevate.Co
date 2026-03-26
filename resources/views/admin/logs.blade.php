<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Logs - Elevate Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-50 font-[Inter]">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-slate-900 text-white p-6 md:p-8 shrink-0 md:sticky md:top-0 md:h-screen flex flex-col">
            <div class="text-2xl font-bold tracking-tight text-white mb-12">ELEVATE. <span
                    class="text-xs bg-indigo-600 px-2 py-1 rounded">ADMIN</span></div>
            <nav class="grid grid-cols-2 gap-2 md:flex md:flex-col md:gap-0 md:space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">Dashboard</a>
                <a href="{{ route('admin.users') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">Manage
                    Users</a>
                <a href="{{ route('admin.logs') }}"
                    class="block px-4 py-3 rounded-lg bg-indigo-600 font-semibold transition">System Logs</a>
                <a href="{{ route('admin.templates') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">Templates</a>
            </nav>
            <div class="mt-auto pt-12">
                <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-white text-sm">Return to Site</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 md:p-12 overflow-hidden">
            <h1 class="text-3xl font-bold text-slate-800 mb-8">System Activity Logs</h1>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 bg-slate-50 border-b border-slate-200">
                    <p class="text-sm text-slate-500">Monitoring real-time system events and user actions.</p>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach($logs as $log)
                        <div class="p-6 flex items-start gap-4 hover:bg-slate-50 transition">
                            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="font-bold text-slate-800">{{ $log['user'] }}</span>
                                    <span class="text-xs text-slate-400">{{ $log['time']->diffForHumans() }}</span>
                                </div>
                                <p class="text-slate-600 text-sm">{{ $log['activity'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>
</body>

</html>