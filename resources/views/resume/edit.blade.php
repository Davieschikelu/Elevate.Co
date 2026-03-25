<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume - Elevate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

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

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Phone</label>
                        <input type="text" name="content[header][phone]"
                            value="{{ $resume->content['header']['phone'] ?? '' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Address</label>
                        <input type="text" name="content[header][address]"
                            value="{{ $resume->content['header']['address'] ?? '' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">City/Town</label>
                        <input type="text" name="content[header][city_town]"
                            value="{{ $resume->content['header']['city_town'] ?? '' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Country</label>
                        <input type="text" name="content[header][country]"
                            value="{{ $resume->content['header']['country'] ?? '' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">LinkedIn (Optional)</label>
                        <input type="url" name="content[header][linkedin]"
                            value="{{ $resume->content['header']['linkedin'] ?? '' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Portfolio Link (Optional)</label>
                        <input type="url" name="content[header][portfolio]"
                            value="{{ $resume->content['header']['portfolio'] ?? '' }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Professional Summary</label>
                    <textarea name="content[summary]" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['summary'] }}</textarea>
                </div>

                <div x-data="{ educations: {{ json_encode(isset($resume->content['education']) && is_array($resume->content['education']) ? $resume->content['education'] : [ ['institution'=>'', 'address'=>'', 'qualification'=>'', 'field'=>'', 'honours'=>'', 'start_date'=>'', 'end_date'=>'', 'current'=>false] ]) }} }">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-slate-700">Education</label>
                        <button type="button" @click="educations.push({ institution: '', address: '', qualification: '', field: '', honours: '', start_date: '', end_date: '', current: false })" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">+ Add Education</button>
                    </div>
                    
                    <div class="space-y-6">
                        <template x-for="(edu, index) in educations" :key="index">
                            <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl relative">
                                <button type="button" @click="educations.splice(index, 1)" x-show="educations.length > 1" class="absolute top-4 right-4 text-slate-400 hover:text-red-600 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Institution Name</label>
                                        <input type="text" x-model="edu.institution" :name="`content[education][${index}][institution]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Institution Address</label>
                                        <input type="text" x-model="edu.address" :name="`content[education][${index}][address]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Qualification</label>
                                        <input type="text" x-model="edu.qualification" :name="`content[education][${index}][qualification]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Field of Study</label>
                                        <input type="text" x-model="edu.field" :name="`content[education][${index}][field]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Honours (Optional)</label>
                                    <input type="text" x-model="edu.honours" :name="`content[education][${index}][honours]`" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Start Date</label>
                                        <input type="month" x-model="edu.start_date" :name="`content[education][${index}][start_date]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1 flex justify-between items-center">
                                            <span>End Date</span>
                                            <div class="flex items-center gap-1">
                                                <input type="checkbox" x-model="edu.current" :name="`content[education][${index}][current]`" value="1" class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                                <span class="text-[10px] text-slate-500">Currently studying</span>
                                            </div>
                                        </label>
                                        <input type="month" x-model="edu.end_date" :name="`content[education][${index}][end_date]`" :disabled="edu.current" :required="!edu.current" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-data="{ experiences: {{ json_encode(isset($resume->content['experience']) && is_array($resume->content['experience']) ? $resume->content['experience'] : []) }} }">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-4">
                            <label class="block text-sm font-semibold text-slate-700">Work Experience</label>
                            <span x-show="experiences.length === 0" class="text-xs text-slate-500 italic">(No experience added)</span>
                        </div>
                        <button type="button" @click="experiences.push({ title: '', employer: '', city: '', country: '', type: 'Remote', start_date: '', end_date: '', current: false })" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">+ Add Job</button>
                    </div>
                    
                    <div class="space-y-6">
                        <template x-for="(exp, index) in experiences" :key="index">
                            <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl relative">
                                <button type="button" @click="experiences.splice(index, 1)" class="absolute top-4 right-4 text-slate-400 hover:text-red-600 transition" title="Remove Job">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Job Title</label>
                                        <input type="text" x-model="exp.title" :name="`content[experience][${index}][title]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Employer</label>
                                        <input type="text" x-model="exp.employer" :name="`content[experience][${index}][employer]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">City/Town</label>
                                        <input type="text" x-model="exp.city" :name="`content[experience][${index}][city]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Country</label>
                                        <input type="text" x-model="exp.country" :name="`content[experience][${index}][country]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-xs font-semibold text-slate-600 mb-1">Job Type</label>
                                    <select x-model="exp.type" :name="`content[experience][${index}][type]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        <option value="Remote">Remote</option>
                                        <option value="On-site">On-site</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Start Date</label>
                                        <input type="month" x-model="exp.start_date" :name="`content[experience][${index}][start_date]`" required class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1 flex justify-between items-center">
                                            <span>End Date</span>
                                            <div class="flex items-center gap-1">
                                                <input type="checkbox" x-model="exp.current" :name="`content[experience][${index}][current]`" value="1" class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                                <span class="text-[10px] text-slate-500">Currently working here</span>
                                            </div>
                                        </label>
                                        <input type="month" x-model="exp.end_date" :name="`content[experience][${index}][end_date]`" :disabled="exp.current" :required="!exp.current" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Skills (comma separated)</label>
                    <textarea name="content[skills]" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ is_array($resume->content['skills'] ?? null) ? implode(', ', $resume->content['skills']) : ($resume->content['skills'] ?? '') }}</textarea>
                </div>

                <div class="pt-6 border-t border-slate-100">
                    <h2 class="text-xl font-bold text-slate-800 mb-4">Additional Sections</h2>
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Awards & Honors</label>
                            <textarea name="content[awards]" rows="3"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['awards'] ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Hobbies & Interests</label>
                            <textarea name="content[hobbies]" rows="2"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['hobbies'] ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Certificates & Licenses</label>
                            <textarea name="content[certificates]" rows="3"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['certificates'] ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Languages</label>
                            <textarea name="content[languages]" rows="2"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['languages'] ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">References</label>
                            <textarea name="content[references]" rows="3"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 transition">{{ $resume->content['references'] ?? '' }}</textarea>
                        </div>
                    </div>
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