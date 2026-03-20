<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Templates - Elevate Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-50 font-[Inter]">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-slate-900 text-white p-6 md:p-8 shrink-0">
            <div class="text-2xl font-bold tracking-tight text-white mb-12">ELEVATE. <span
                    class="text-xs bg-indigo-600 px-2 py-1 rounded">ADMIN</span></div>
            <nav class="grid grid-cols-2 gap-2 md:flex md:flex-col md:gap-0 md:space-y-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">Dashboard</a>
                <a href="{{ route('admin.users') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">Manage
                    Users</a>
                <a href="{{ route('admin.logs') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-white transition">System
                    Logs</a>
                <a href="{{ route('admin.templates') }}"
                    class="block px-4 py-3 rounded-lg bg-indigo-600 font-semibold transition">Templates</a>
            </nav>
            <div class="mt-auto pt-12">
                <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-white text-sm">Return to Site</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 md:p-12 overflow-hidden">
            <h1 class="text-3xl font-bold text-slate-800 mb-8">Templates & Settings</h1>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center">
                <div
                    class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Editor Coming Soon</h2>
                <p class="text-slate-500 max-w-sm mx-auto">The template management interface is currently under
                    development. This will allow you to customize the LLM prompts and styles for Academic, Developer,
                    and Marketing resumes.</p>
            </div>
        </main>
    </div>
</body>

</html>