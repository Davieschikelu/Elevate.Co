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

<body class="bg-slate-50 text-slate-900 antialiased">
    <div x-data="{ 
        toast: { show: false, message: '', type: 'success' },
        showToast(message, type = 'success') {
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            setTimeout(() => this.toast.show = false, 3000);
        }
    }" @if(session('success')) x-init="setTimeout(() => showToast('{{ session('success') }}', 'success'), 500)" @endif
        @if(session('error')) x-init="setTimeout(() => showToast('{{ session('error') }}', 'error'), 500)" @endif
        class="min-h-screen bg-slate-50 flex items-center justify-center p-4 md:p-10 relative">

        <!-- Toast Notification -->
        <div x-show="toast.show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="fixed top-5 right-5 z-50 transform pointer-events-none">
            <div :class="toast.type === 'success' ? 'bg-green-50 text-green-800 border-green-200' : 'bg-red-50 text-red-800 border-red-200'"
                class="px-4 py-3 rounded-xl shadow-lg border flex items-center gap-3 min-w-[300px]">
                <div :class="toast.type === 'success' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'"
                    class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0">
                    <template x-if="toast.type === 'success'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </template>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm" x-text="toast.type === 'success' ? 'Success' : 'Error'"></p>
                    <p class="text-sm opacity-90" x-text="toast.message"></p>
                </div>
            </div>
        </div>

        <div
            class="bg-white w-full max-w-5xl min-h-[700px] rounded-[2.5rem] shadow-2xl shadow-indigo-100 flex overflow-hidden relative">

            <div class="hidden lg:flex w-1/2 bg-indigo-600 relative overflow-hidden p-12 flex-col justify-between">
                <div
                    class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse">
                </div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-bounce"
                    style="animation-duration: 10s;"></div>

                <div class="relative z-10">
                    <div class="text-white font-black text-2xl italic tracking-tighter">ELEVATE</div>
                </div>

                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white leading-tight mb-4">
                        Build your future <br> <span class="text-indigo-200">starting today.</span>
                    </h2>
                    <p class="text-indigo-100 text-lg">Join thousands of professionals who have accelerated their careers with Elevate.</p>
                </div>

                <div
                    class="relative z-10 bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-2xl transform -rotate-3 hover:rotate-0 transition-transform duration-700">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-200/30"></div>
                        <div class="h-2 w-24 bg-indigo-200/30 rounded"></div>
                    </div>
                    <div class="space-y-2">
                        <div class="h-2 w-full bg-white/20 rounded"></div>
                        <div class="h-2 w-5/6 bg-white/20 rounded"></div>
                        <div class="h-2 w-4/6 bg-white/20 rounded"></div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 p-8 md:p-16 flex flex-col justify-center relative overflow-hidden">
                <a href="{{ route('home') }}"
                    class="absolute top-6 right-6 flex items-center gap-2 text-slate-400 hover:text-indigo-600 transition-colors group">
                    <span class="text-sm font-semibold group-hover:underline">Home</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>

                <div class="w-full">
                    <h3 class="text-3xl font-black text-slate-800 mb-2">Create Account</h3>
                    <p class="text-slate-500 mb-8">Join the community and start building.</p>

                    <!-- Google Sign In Button -->
                    <a href="{{ route('auth.google') }}"
                        class="flex items-center justify-center gap-3 w-full bg-white text-slate-700 border border-slate-200 px-6 py-3 rounded-2xl font-bold hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 mb-6 group">
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
                        <span class="flex-shrink-0 mx-4 text-slate-300 text-xs font-bold uppercase">Or register with
                            email</span>
                        <div class="flex-grow border-t border-slate-100"></div>
                    </div>

                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-lg">
                            <ul class="text-xs">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all duration-300"
                                placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email
                                Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all duration-300"
                                placeholder="name@company.com">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Password</label>
                                <input type="password" name="password" required autocomplete="new-password"
                                    class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all duration-300"
                                    placeholder="••••••••">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Confirm</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all duration-300"
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-lg hover:bg-indigo-600 hover:shadow-xl hover:shadow-indigo-200 transition-all duration-300 flex items-center justify-center gap-3">
                            Sign Up
                        </button>
                    </form>

                    <p class="text-center mt-8 text-slate-500">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>