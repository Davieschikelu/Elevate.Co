<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resume - Elevate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50">
    <nav class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tight text-indigo-600">ELEVATE.</div>
        <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Back to
            Dashboard</a>
    </nav>

    <div class="max-w-2xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h1 class="text-2xl font-bold text-slate-800 mb-2">Step 1: Key Information</h1>
            <p class="text-slate-500 mb-8">Enter your basic details to get started.</p>

            <form action="{{ route('resume.store-info') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Education</label>
                    <textarea name="education" required rows="3"
                        placeholder="e.g. BSc in Computer Science, University of Lagos"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('education') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Work Experience</label>
                    <textarea name="experience" required rows="4"
                        placeholder="e.g. Software Engineer at TechCorp (2 years)"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('experience') }}</textarea>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-indigo-600 text-white rounded-xl font-bold text-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    Next: Choose Context
                </button>
            </form>
        </div>
    </div>
</body>

</html>