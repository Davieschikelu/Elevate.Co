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
        <h1 class="text-3xl font-bold text-slate-800 mb-8">My Resumes</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Create New Resume Card -->
            <div
                class="bg-white border-2 border-dashed border-slate-300 rounded-xl p-8 flex flex-col items-center justify-center text-center hover:border-indigo-400 hover:bg-indigo-50/50 transition cursor-pointer group h-64">
                <div
                    class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-700 group-hover:text-indigo-700">Create New Resume</h3>
                <p class="text-slate-500 text-sm mt-2">Start from scratch or use a template</p>
            </div>
        </div>
    </div>
</body>

</html>