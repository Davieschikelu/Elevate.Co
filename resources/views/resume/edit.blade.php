<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume - Elevate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-50 font-[Inter]">
    <nav class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tight text-indigo-600">ELEVATE.</div>
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Dashboard</a>
            <a href="{{ route('resume.export', $resume->id) }}"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">Export
                PDF</a>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-8 py-12">
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

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                <h1 class="text-2xl font-bold text-slate-800">Review & Edit Generated Resume</h1>
                <p class="text-slate-500">Manual adjustments can be made below before exporting.</p>
            </div>

            <form action="{{ route('resume.update', $resume->id) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Name</label>
                        <input type="text" name="content[header][name]" value="{{ $resume->content['header']['name'] }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <input type="email" name="content[header][email]"
                            value="{{ $resume->content['header']['email'] }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Professional Summary</label>
                    <textarea name="content[summary]" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['summary'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Education</label>
                    <textarea name="content[education]" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['education'] }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Experience</label>
                    <textarea name="content[experience]" rows="6"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['experience'] }}</textarea>
                </div>

                <div class="flex justify-end gap-4 border-t border-slate-100 pt-8">
                    <button type="submit"
                        class="px-8 py-3 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition shadow-lg">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>