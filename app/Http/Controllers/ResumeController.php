<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Auth::user()->resumes()->latest()->get();
        return view('dashboard', compact('resumes'));
    }

    public function create()
    {
        return view('resume.create');
    }

    public function storeInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'city_town' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'linkedin' => 'nullable|url|max:255',
            'portfolio' => 'nullable|url|max:255',
            'education' => 'required|array|min:1',
            'education.*.institution' => 'required|string|max:255',
            'education.*.address' => 'required|string|max:255',
            'education.*.qualification' => 'required|string|max:255',
            'education.*.field' => 'required|string|max:255',
            'education.*.honours' => 'nullable|string|max:255',
            'education.*.start_date' => 'required|string|max:20',
            'education.*.end_date' => 'nullable|string|max:20',
            'education.*.current' => 'nullable|boolean',
            'experience' => $request->has('no_experience') ? 'nullable|array' : 'required|array|min:1',
            'experience.*.title' => 'required_with:experience|string|max:255',
            'experience.*.employer' => 'required_with:experience|string|max:255',
            'experience.*.city' => 'required_with:experience|string|max:255',
            'experience.*.country' => 'required_with:experience|string|max:255',
            'experience.*.type' => 'required_with:experience|string|max:50',
            'experience.*.start_date' => 'required_with:experience|string|max:20',
            'experience.*.end_date' => 'nullable|string|max:20',
            'experience.*.current' => 'nullable|boolean',
            'skills' => 'required|string',
            'awards' => 'nullable|string',
            'hobbies' => 'nullable|string',
            'certificates' => 'nullable|string',
            'languages' => 'nullable|string',
            'references' => 'nullable|string',
        ]);

        session(['resume_info' => $validated]);

        return redirect()->route('resume.select-context');
    }

    public function selectContext()
    {
        if (!session()->has('resume_info')) {
            return redirect()->route('resume.create')->with('error', 'Please provide your information first.');
        }

        return view('resume.select_context');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'context_type' => 'required|in:academic,developer,marketing',
        ]);

        $info = session('resume_info');
        $context = $request->context_type;

        // Mocking LLM generation logic
        $generatedContent = [
            'header' => [
                'name' => $info['name'],
                'email' => $info['email'],
                'phone' => $info['phone'],
                'address' => $info['address'],
                'city_town' => $info['city_town'],
                'country' => $info['country'],
                'linkedin' => $info['linkedin'] ?? null,
                'portfolio' => $info['portfolio'] ?? null,
            ],
            'summary' => "Professional resume generated for {$context} context.",
            'education' => $info['education'],
            'experience' => $info['experience'] ?? [],
            'skills' => array_values(array_filter(array_map('trim', explode(',', $info['skills'] ?? '')))),
            'awards' => $info['awards'] ?? null,
            'hobbies' => $info['hobbies'] ?? null,
            'certificates' => $info['certificates'] ?? null,
            'languages' => $info['languages'] ?? null,
            'references' => $info['references'] ?? null,
        ];

        $resume = Resume::create([
            'user_id' => Auth::id(),
            'title' => 'Resume - ' . now()->format('Y-m-d H:i'),
            'context_type' => $context,
            'content' => $generatedContent,
        ]);

        ActivityLog::record("Generated a new {$context} resume.");

        session()->forget('resume_info');

        return redirect()->route('resume.edit', $resume->id)->with('success', 'Resume generated successfully!');
    }

    public function edit(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        return view('resume.edit', compact('resume'));
    }

    public function update(Request $request, Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|array',
        ]);

        $content = $request->content;
        
        // Ensure skills are saved as an array
        if (isset($content['skills']) && is_string($content['skills'])) {
            $content['skills'] = array_values(array_filter(array_map('trim', explode(',', $content['skills']))));
        }

        $resume->update(['content' => $content]);
        ActivityLog::record("Updated resume '{$resume->title}'.");

        return back()->with('success', 'Resume updated successfully!');
    }

    public function export(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        // Placeholder for PDF export logic
        return "PDF Export functionality for Resume #{$resume->id} is not yet implemented. This would typically use a library like DomPDF.";
    }

    public function destroy(Resume $resume)
    {
        if ($resume->user_id !== Auth::id()) {
            abort(403);
        }

        $resumeTitle = $resume->title;
        $resume->delete();
        ActivityLog::record("Deleted resume '{$resumeTitle}'.");

        return back()->with('success', 'Resume deleted successfully!');
    }
}
