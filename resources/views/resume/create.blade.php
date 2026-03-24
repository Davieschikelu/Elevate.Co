<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resume - Elevate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-slate-50">
    <nav class="bg-white border-b border-slate-200 px-8 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tight text-indigo-600">ELEVATE.</div>
        <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-indigo-600 font-medium">Back to
            Dashboard</a>
    </nav>

    <div class="max-w-3xl mx-auto px-8 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8" x-data="{ step: 1 }">
            <h1 class="text-2xl font-bold text-slate-800 mb-2">Build Your Resume</h1>
            <p class="text-slate-500 mb-8">Follow the steps below to craft a professional resume.</p>

            <!-- Progress Bar -->
            <div class="mb-10">
                <div class="flex justify-between text-xs font-bold text-slate-400 mb-3 px-1">
                    <span :class="step >= 1 ? 'text-indigo-600' : ''">Personal Details</span>
                    <span :class="step >= 2 ? 'text-indigo-600' : ''">Education</span>
                    <span :class="step >= 3 ? 'text-indigo-600' : ''">Experience</span>
                    <span :class="step >= 4 ? 'text-indigo-600' : ''">Skills & Extras</span>
                </div>
                <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-600 transition-all duration-500 ease-out rounded-full shadow-[0_0_10px_rgba(79,70,229,0.5)]" 
                         :style="`width: ${(step / 4) * 100}%`"></div>
                </div>
            </div>

            <form action="{{ route('resume.store-info') }}" method="POST" class="space-y-6">
                @csrf

                <!-- STEP 1: Personal Details -->
                <div x-show="step === 1" data-step="1" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-xl font-bold text-slate-800 mb-6 pb-2 border-b border-slate-100">1. Personal Details</h2>
                    
                    <div class="space-y-6">
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

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Address</label>
                                <input type="text" name="address" value="{{ old('address') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">City/Town</label>
                                <input type="text" name="city_town" value="{{ old('city_town') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Country</label>
                                <input type="text" name="country" value="{{ old('country') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">LinkedIn (Optional)</label>
                                <input type="url" name="linkedin" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/..."
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Portfolio Link (Optional)</label>
                                <input type="url" name="portfolio" value="{{ old('portfolio') }}" placeholder="https://yourportfolio.com"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: Education -->
                <div x-show="step === 2" data-step="2" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-xl font-bold text-slate-800 mb-6 pb-2 border-b border-slate-100">2. Education</h2>
                    
                    <div x-data="{ educations: [ { institution: '', address: '', qualification: '', field: '', honours: '', start_date: '', end_date: '', current: false } ] }">
                        <div class="space-y-6">
                            <template x-for="(edu, index) in educations" :key="index">
                                <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl relative shadow-sm">
                                    <button type="button" @click="educations.splice(index, 1)" x-show="educations.length > 1" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 transition" title="Remove Education">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                    
                                    <h3 class="text-sm font-bold text-indigo-600 mb-4" x-text="`Education #${index + 1}`"></h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Institution Name</label>
                                            <input type="text" x-model="edu.institution" :name="`education[${index}][institution]`" :required="step === 2" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Institution Address</label>
                                            <input type="text" x-model="edu.address" :name="`education[${index}][address]`" :required="step === 2" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Qualification (e.g., BSc, MSc)</label>
                                            <input type="text" x-model="edu.qualification" :name="`education[${index}][qualification]`" :required="step === 2" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Field of Study</label>
                                            <input type="text" x-model="edu.field" :name="`education[${index}][field]`" :required="step === 2" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Honours (Optional)</label>
                                        <input type="text" x-model="edu.honours" :name="`education[${index}][honours]`" placeholder="e.g. First Class, Cum Laude" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Start Date</label>
                                            <input type="month" x-model="edu.start_date" :name="`education[${index}][start_date]`" :required="step === 2" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1 flex justify-between items-center">
                                                <span>End Date</span>
                                                <div class="flex items-center gap-1">
                                                    <input type="checkbox" x-model="edu.current" :name="`education[${index}][current]`" value="1" class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                                    <span class="text-[10px] text-slate-500">Currently studying</span>
                                                </div>
                                            </label>
                                            <input type="month" x-model="edu.end_date" :name="`education[${index}][end_date]`" :disabled="edu.current" :required="step === 2 && !edu.current" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400 bg-white">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <div class="mt-4 flex justify-center">
                            <button type="button" @click="educations.push({ institution: '', address: '', qualification: '', field: '', honours: '', start_date: '', end_date: '', current: false })" 
                                    class="px-4 py-2 border-2 border-dashed border-indigo-200 text-indigo-600 font-semibold rounded-xl hover:bg-indigo-50 hover:border-indigo-300 transition w-full">
                                + Add Another Education
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STEP 3: Work Experience -->
                <div x-show="step === 3" data-step="3" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-xl font-bold text-slate-800 mb-6 pb-2 border-b border-slate-100">3. Work Experience</h2>
                    
                    <div x-data="{ experiences: [ { title: '', employer: '', city: '', country: '', type: 'Remote', start_date: '', end_date: '', current: false } ] }">
                        <div class="space-y-6">
                            <template x-for="(exp, index) in experiences" :key="index">
                                <div class="p-6 bg-slate-50 border border-slate-200 rounded-xl relative shadow-sm">
                                    <button type="button" @click="experiences.splice(index, 1)" x-show="experiences.length > 1" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 transition" title="Remove Job">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                    
                                    <h3 class="text-sm font-bold text-indigo-600 mb-4" x-text="`Job #${index + 1}`"></h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Job Title</label>
                                            <input type="text" x-model="exp.title" :name="`experience[${index}][title]`" :required="step === 3" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Employer</label>
                                            <input type="text" x-model="exp.employer" :name="`experience[${index}][employer]`" :required="step === 3" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">City/Town</label>
                                            <input type="text" x-model="exp.city" :name="`experience[${index}][city]`" :required="step === 3" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Country</label>
                                            <input type="text" x-model="exp.country" :name="`experience[${index}][country]`" :required="step === 3" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Job Type</label>
                                        <select x-model="exp.type" :name="`experience[${index}][type]`" :required="step === 3" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                            <option value="Remote">Remote</option>
                                            <option value="On-site">On-site</option>
                                            <option value="Hybrid">Hybrid</option>
                                        </select>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Start Date</label>
                                            <input type="month" x-model="exp.start_date" :name="`experience[${index}][start_date]`" :required="step === 3" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1 flex justify-between items-center">
                                                <span>End Date</span>
                                                <div class="flex items-center gap-1">
                                                    <input type="checkbox" x-model="exp.current" :name="`experience[${index}][current]`" value="1" class="rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                                                    <span class="text-[10px] text-slate-500">Currently working here</span>
                                                </div>
                                            </label>
                                            <input type="month" x-model="exp.end_date" :name="`experience[${index}][end_date]`" :disabled="exp.current" :required="step === 3 && !exp.current" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:bg-slate-100 disabled:text-slate-400 bg-white">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="mt-4 flex justify-center">
                            <button type="button" @click="experiences.push({ title: '', employer: '', city: '', country: '', type: 'Remote', start_date: '', end_date: '', current: false })" 
                                    class="px-4 py-2 border-2 border-dashed border-indigo-200 text-indigo-600 font-semibold rounded-xl hover:bg-indigo-50 hover:border-indigo-300 transition w-full">
                                + Add Another Job
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STEP 4: Skills & Extras -->
                <div x-show="step === 4" data-step="4" x-cloak x-transition:enter="transition ease-out duration-300 delay-100"
                     x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-xl font-bold text-slate-800 mb-6 pb-2 border-b border-slate-100">4. Skills & Extras</h2>
                    
                    <div class="space-y-6 mb-8">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Core Skills <span class="text-red-500">*</span></label>
                            <textarea name="skills" rows="3" :required="step === 4"
                                placeholder="e.g. JavaScript, Python, Communication, Problem Solving (separate with commas)"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('skills') }}</textarea>
                        </div>

                        <div class="pt-6 border-t border-slate-100">
                            <h3 class="text-lg font-bold text-slate-700 mb-4">Additional Information (Optional)</h3>
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Awards & Honors</label>
                                    <textarea name="awards" rows="2" placeholder="e.g. Best Employee 2023, First Class Honors"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('awards') }}</textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Hobbies & Interests</label>
                                    <textarea name="hobbies" rows="2" placeholder="e.g. Photography, Open Source Contributing"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('hobbies') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Certificates & Licenses</label>
                                    <textarea name="certificates" rows="2" placeholder="e.g. AWS Certified Solutions Architect, PMP"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('certificates') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Languages</label>
                                    <textarea name="languages" rows="2" placeholder="e.g. English (Native), Spanish (Intermediate)"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('languages') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">References</label>
                                    <textarea name="references" rows="2" placeholder="e.g. Available upon request"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('references') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center pt-8 border-t border-slate-200 mt-8">
                    <button type="button" x-show="step > 1" @click="step--" 
                            class="px-6 py-3 bg-white border border-slate-300 text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
                        ⟵ Back
                    </button>
                    <div x-show="step === 1"></div>
                    
                    <button type="button" x-show="step < 4" @click="
                            const currentStepEl = document.querySelector(`[data-step='${step}']`);
                            if (currentStepEl) {
                                const inputs = currentStepEl.querySelectorAll('input[required]:not([disabled]), select[required]:not([disabled]), textarea[required]:not([disabled])');
                                let isValid = true;
                                for (const input of inputs) {
                                    if (!input.checkValidity()) {
                                        input.reportValidity();
                                        isValid = false;
                                        break;
                                    }
                                }
                                if (isValid) step++;
                            } else {
                                step++;
                            }
                        " 
                            class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center gap-2">
                        Next Step ⟶
                    </button>
                    
                    <button type="submit" x-show="step === 4" 
                            class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-bold rounded-xl hover:from-indigo-700 hover:to-indigo-800 transition shadow-lg shadow-indigo-200 flex items-center gap-2">
                        Generate Resume ✓
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>