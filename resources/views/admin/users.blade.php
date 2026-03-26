<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Elevate Admin</title>
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
                    class="block px-4 py-3 rounded-lg bg-indigo-600 font-semibold transition">Manage Users</a>
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
        <main class="flex-1 p-4 sm:p-6 md:p-12 overflow-hidden">
            <h1 class="text-3xl font-bold text-slate-800 mb-8">User Management</h1>

            @if(session('success'))
                <div class="mb-6 bg-green-50 text-green-800 border border-green-200 p-4 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap min-w-max">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">User</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Email</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Role</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-slate-800 font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 text-xs font-bold rounded {{ $user->isAdmin() ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-semibold text-sm">Delete</button>
                                        </form>
                                    @else
                                        <span class="text-slate-400 text-sm">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </main>
    </div>
</body>

</html>