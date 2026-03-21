<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elevate | Professional Resume Builder</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

    <nav class="relative z-50 flex items-center justify-between px-8 py-6 max-w-7xl mx-auto">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/logo.jpg') }}" alt="Elevate Logo" class="h-8 w-8 rounded-full object-cover">
            <div class="text-2xl font-bold tracking-tight text-indigo-600">ELEVATE.</div>
        </div>
        <div class="hidden lg:flex space-x-8 font-medium text-slate-600">
            <a href="#" class="hover:text-indigo-600 transition">Templates</a>
            <a href="#" class="hover:text-indigo-600 transition">Examples</a>
            <a href="#" class="hover:text-indigo-600 transition">Pricing</a>
        </div>
        <div class="hidden lg:flex flex-row items-center gap-2">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-slate-600 font-medium">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-slate-600 font-medium">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 px-6 py-2.5 bg-indigo-600 text-white rounded-full font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">Build My Resume</a>
                    @endif
                @endauth
            @endif
        </div>
        <!-- Mobile Menu Button -->
        <div class="lg:hidden flex items-center">
            <button id="mobile-menu-button" class="text-slate-600 hover:text-indigo-600 focus:outline-none p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white shadow-xl absolute w-full z-40 left-0 border-b border-slate-100 pb-4">
        <div class="px-8 py-4 flex flex-col space-y-4">
            <a href="#" class="text-slate-600 hover:text-indigo-600 font-medium transition">Templates</a>
            <a href="#" class="text-slate-600 hover:text-indigo-600 font-medium transition">Examples</a>
            <a href="#" class="text-slate-600 hover:text-indigo-600 font-medium transition">Pricing</a>
            <hr class="border-slate-100">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-slate-600 font-medium">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 font-medium">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block text-center mt-2 px-6 py-2.5 bg-indigo-600 text-white rounded-full font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">Build My Resume</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    <header class="relative pt-16 pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span
                    class="inline-block px-4 py-1.5 mb-6 text-sm font-semibold tracking-wide text-indigo-700 uppercase bg-indigo-50 rounded-full">
                    Trusted by 50,000+ Professionals
                </span>
                <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-6">
                    Landing your dream job <span class="text-indigo-600">starts here.</span>
                </h1>
                <p class="text-lg text-slate-600 mb-10 leading-relaxed">
                    Build a professional, ATS-friendly resume in minutes. Choose from designer templates and get expert
                    tips to stand out from the crowd.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}"
                        class="px-8 py-4 bg-slate-900 text-white rounded-xl font-bold text-lg hover:bg-slate-800 transition shadow-xl text-center">
                        Create My Resume
                    </a>
                    <button
                        class="px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-lg hover:border-indigo-400 transition">
                        View Templates
                    </button>
                </div>
            </div>

            <div class="relative">
                <div
                    class="absolute -top-12 -left-12 w-64 h-64 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70">
                </div>
                <div
                    class="relative bg-white p-4 rounded-2xl shadow-2xl border border-slate-100 transform rotate-2 hover:rotate-0 transition duration-500">
                    <!-- Placeholder image -->
                    <div
                        class="w-full h-[600px] bg-slate-200 rounded-lg flex items-center justify-center text-slate-400">
                        Resume Template Preview
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold mb-4">Why choose Elevate?</h2>
                <p class="text-slate-500">We’ve engineered our platform to bypass applicant tracking systems while
                    looking stunning to human recruiters.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <div
                    class="group p-8 rounded-2xl border border-slate-50 hover:border-indigo-100 hover:bg-indigo-50/30 transition">
                    <div
                        class="w-12 h-12 bg-indigo-600 text-white flex items-center justify-center rounded-lg mb-6 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Instant Generation</h3>
                    <p class="text-slate-500">Input your details and watch your resume format itself perfectly in
                        real-time.</p>
                </div>

                <div
                    class="group p-8 rounded-2xl border border-slate-50 hover:border-indigo-100 hover:bg-indigo-50/30 transition">
                    <div
                        class="w-12 h-12 bg-indigo-600 text-white flex items-center justify-center rounded-lg mb-6 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04rem" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">ATS-Friendly</h3>
                    <p class="text-slate-500">Our templates are tested against major HR software to ensure you never get
                        filtered out.</p>
                </div>

                <div
                    class="group p-8 rounded-2xl border border-slate-50 hover:border-indigo-100 hover:bg-indigo-50/30 transition">
                    <div
                        class="w-12 h-12 bg-indigo-600 text-white flex items-center justify-center rounded-lg mb-6 group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">One-Click Export</h3>
                    <p class="text-slate-500">Download your resume in high-quality PDF or share it via a unique
                        professional link.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 py-12 text-slate-400 px-8">
        <div
            class="max-w-7xl mx-auto flex flex-col md:row justify-between items-center border-b border-slate-800 pb-8 mb-8">
            <div class="text-white font-bold text-xl mb-4 md:mb-0">ELEVATE.</div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
                <a href="#" class="hover:text-white transition">Contact</a>
            </div>
        </div>
        <div class="text-center text-sm">
            &copy; {{ date('Y') }} Elevate Resume Builder. All rights reserved.
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    </script>
</body>

</html>