<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Elevate</title>
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

<body class="bg-slate-50 flex items-center justify-center min-h-screen py-10" x-data="{ 
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

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md border border-slate-100 relative">
        <a href="{{ route('home') }}" class="absolute top-4 right-4 text-slate-400 hover:text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        <h2 class="text-3xl font-bold text-center text-slate-800 mb-2">Create Account</h2>
        <p class="text-center text-slate-500 mb-6">Join thousands of professionals.</p>

        <!-- Google Sign Up Button -->
        <a href="{{ route('auth.google') }}"
            class="flex items-center justify-center gap-3 w-full bg-slate-50 text-slate-700 border border-slate-200 px-6 py-3 rounded-xl font-bold hover:bg-slate-100 hover:border-slate-300 transition-all duration-200 mb-6 group">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                    fill="#4285F4" />
                <path
                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                    fill="#34A853" />
                <path
                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                    fill="#FBBC05" />
                <path
                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                    fill="#EA4335" />
            </svg>
            <span class="group-hover:text-slate-900">Sign up with Google</span>
        </a>

        <div class="relative flex py-2 items-center mb-6">
            <div class="flex-grow border-t border-slate-100"></div>
            <span class="flex-shrink-0 mx-4 text-slate-300 text-xs font-bold uppercase">Or register with email</span>
            <div class="flex-grow border-t border-slate-100"></div>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-5">
                <label class="block text-slate-600 font-medium mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    placeholder="John Doe">
            </div>
            <div class="mb-5">
                <label class="block text-slate-600 font-medium mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    placeholder="you@example.com">
            </div>
            <div class="mb-6">
                <label class="block text-slate-600 font-medium mb-2">Password</label>
                <input type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    placeholder="••••••••">
            </div>
            <div class="mb-6">
                <label class="block text-slate-600 font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                Sign Up
            </button>
        </form>
        <p class="text-center mt-6 text-slate-500">
            Already have an account? <a href="{{ route('login') }}"
                class="text-indigo-600 font-bold hover:underline">Log in</a>
        </p>
    </div>
</body>

</html>