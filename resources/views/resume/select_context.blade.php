<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Context - Elevate</title>
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
        <a href="{{ route('resume.create') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Back to Info</a>
    </nav>

    <div class="max-w-4xl mx-auto px-8 py-12 text-center">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">Step 2: Choose Application Context</h1>
        <p class="text-slate-500 mb-12">Select the type of role or environment you are applying for.</p>

        <form action="{{ route('resume.generate') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @csrf

            <label class="relative group cursor-pointer">
                <input type="radio" name="context_type" value="academic" class="peer sr-only" required>
                <div
                    class="bg-white border-2 border-slate-200 rounded-2xl p-8 transition peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50 hover:border-indigo-300">
                    <div
                        class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800">Academic</h3>
                    <p class="text-sm text-slate-500 mt-2">Focused on research, teaching, and academic achievements.</p>
                </div>
            </label>

            <label class="relative group cursor-pointer">
                <input type="radio" name="context_type" value="developer" class="peer sr-only">
                <div
                    class="bg-white border-2 border-slate-200 rounded-2xl p-8 transition peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50 hover:border-indigo-300">
                    <div
                        class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800">Developer</h3>
                    <p class="text-sm text-slate-500 mt-2">Highlights technical skills, projects, and coding expertise.
                    </p>
                </div>
            </label>

            <label class="relative group cursor-pointer">
                <input type="radio" name="context_type" value="marketing" class="peer sr-only">
                <div
                    class="bg-white border-2 border-slate-200 rounded-2xl p-8 transition peer-checked:border-indigo-600 peer-checked:bg-indigo-50/50 hover:border-indigo-300">
                    <div
                        class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800">Marketing</h3>
                    <p class="text-sm text-slate-500 mt-2">Emphasizes strategy, results, and creative professional work.
                    </p>
                </div>
            </label>

            <div class="md:col-span-3 mt-12">
                <button type="submit"
                    class="px-12 py-4 bg-indigo-600 text-white rounded-xl font-bold text-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                    Generate Resume using LLM
                </button>
            </div>
        </form>
    </div>
</body>

</html>