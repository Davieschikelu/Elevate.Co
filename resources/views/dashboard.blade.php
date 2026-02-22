<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Elevate</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50" x-data="{ 
        toast: { show: false, message: '', type: 'success' },
        showToast(message, type = 'success') {
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            setTimeout(() => this.toast.show = false, 3000);
        }
    }" @if(session('success')) x-init="setTimeout(() => showToast('{{ session('success') }}', 'success'), 500)" @endif
    @if(session('error')) x-init="setTimeout(() => showToast('{{ session('error') }}', 'error'), 500)" @endif>
    <!-- Toast Notification -->
    <div x-show="toast.show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2" class="fixed top-5 right-5 z-50 transform pointer-events-none">
        <div :class="toast.type === 'success' ? 'bg-green-50 text-green-800 border-green-200' : 'bg-red-50 text-red-800 border-red-200'"
            class="px-4 py-3 rounded-xl shadow-lg border flex items-center gap-3 min-w-[300px]">
            <div :class="toast.type === 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'"
                class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
                <template x-if="toast.type === 'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </template>
                <template x-if="toast.type === 'error'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </template>
            </div>
            <div class="flex-1">
                <p class="font-semibold text-sm" x-text="toast.type === 'success' ? 'Success' : 'Error'"></p>
                <p class="text-sm opacity-90" x-text="toast.message"></p>
            </div>
        </div>
    </div>
    <nav class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tight text-indigo-600">ELEVATE.</div>
        <div class="flex items-center gap-4">
            <span class="text-slate-600 font-medium">Welcome, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-sm text-red-600 font-semibold hover:bg-red-50 px-4 py-2 rounded-lg transition">Log
                    Out</button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">My Resumes</h1>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}"
                    class="text-indigo-600 font-semibold hover:bg-indigo-50 px-4 py-2 rounded-lg transition">Admin Panel</a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Create New Resume Card -->
            <a href="{{ route('resume.create') }}"
                class="bg-white border-2 border-dashed border-slate-300 rounded-xl p-8 flex flex-col items-center justify-center text-center hover:border-indigo-400 hover:bg-indigo-50/50 transition cursor-pointer group h-64">
                <div
                    class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-700 group-hover:text-indigo-700">Create New Resume</h3>
                <p class="text-slate-500 text-sm mt-2">Generate a resume using LLM</p>
            </a>

            <!-- Existing Resumes -->
            @foreach($resumes as $resume)
                <div
                    class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full uppercase">
                                {{ $resume->context_type }}
                            </span>
                            <span class="text-slate-400 text-xs">{{ $resume->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-2">{{ $resume->title }}</h4>
                        <p class="text-slate-500 text-sm line-clamp-2 mb-4">
                            {{ $resume->content['summary'] ?? 'No summary available.' }}</p>

                        <div class="flex gap-3">
                            <a href="{{ route('resume.edit', $resume->id) }}"
                                class="flex-1 text-center py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-200 transition">Edit</a>
                            <a href="{{ route('resume.export', $resume->id) }}"
                                class="flex-1 text-center py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">PDF</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>