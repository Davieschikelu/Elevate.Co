<?php

namespace App\Http\Controllers;

use App\Models\Resume;
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
            'education' => 'required|string',
            'experience' => 'required|string',
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
            ],
            'summary' => "Professional resume generated for {$context} context.",
            'education' => $info['education'],
            'experience' => $info['experience'],
            'skills' => ['Communication', 'Teamwork', 'Problem Solving'], // Placeholder
        ];

        $resume = Resume::create([
            'user_id' => Auth::id(),
            'title' => 'Resume - ' . now()->format('Y-m-d H:i'),
            'context_type' => $context,
            'content' => $generatedContent,
        ]);

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

        $resume->update(['content' => $request->content]);

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

        $resume->delete();

        return back()->with('success', 'Resume deleted successfully!');
    }
}
