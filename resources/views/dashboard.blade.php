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
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-slate-50" x-data="{ 
        toast: { show: false, message: '', type: 'success' },
        showToast(message, type = 'success') {
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            setTimeout(() => this.toast.show = false, 3000);
        },
        deleteModal: { show: false, formId: null },
        openDeleteModal(id) {
            this.deleteModal.formId = id;
            this.deleteModal.show = true;
        },
        confirmDelete() {
            if (this.deleteModal.formId) {
                document.getElementById(this.deleteModal.formId).submit();
            }
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
    <nav class="bg-white border-b border-slate-200 px-4 sm:px-8 py-4 flex justify-between items-center relative z-40" x-data="{ mobileMenuOpen: false }">
        <div class="text-2xl font-bold tracking-tight text-indigo-600">ELEVATE.</div>
        
        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-4">
            <span class="text-slate-600 font-medium truncate max-w-[200px]">Welcome, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-sm text-red-600 font-semibold hover:bg-red-50 px-4 py-2 rounded-lg transition">Log
                    Out</button>
            </form>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 hover:text-indigo-600 focus:outline-none p-2">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition x-cloak
            class="md:hidden absolute top-full left-0 w-full bg-white border-b border-slate-200 shadow-xl z-50">
            <div class="px-6 py-4 flex flex-col space-y-4">
                <span class="text-slate-600 font-medium">Welcome, {{ Auth::user()->name }}</span>
                <hr class="border-slate-100">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full text-left font-semibold text-red-600 hover:bg-red-50 px-3 py-2 rounded-lg transition">Log
                        Out</button>
                </form>
            </div>
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
                            {{ $resume->content['summary'] ?? 'No summary available.' }}
                        </p>

                        <div class="flex gap-2">
                            <a href="{{ route('resume.edit', $resume->id) }}"
                                class="flex-1 text-center py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-200 transition">Edit</a>
                            <a href="{{ route('resume.export', $resume->id) }}"
                                class="flex-1 text-center py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">PDF</a>
                            <form id="delete-form-{{ $resume->id }}" action="{{ route('resume.destroy', $resume->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="button" @click="openDeleteModal('delete-form-{{ $resume->id }}')"
                                    class="w-full text-center py-2 bg-red-100 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-200 transition">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="deleteModal.show" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="deleteModal.show" 
                x-transition:enter="ease-out duration-300" 
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100" 
                x-transition:leave="ease-in duration-200" 
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0" 
                class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="deleteModal.show = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div x-show="deleteModal.show" 
                x-transition:enter="ease-out duration-300" 
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave="ease-in duration-200" 
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-slate-900" id="modal-title">Delete Resume</h3>
                            <div class="mt-2">
                                <p class="text-sm text-slate-500">Are you sure you want to delete this resume? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                    <button type="button" @click="confirmDelete()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition">Delete</button>
                    <button type="button" @click="deleteModal.show = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>