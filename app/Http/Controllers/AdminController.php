<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resume;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'resumes_count' => Resume::count(),
            'recent_users' => User::latest()->take(5)->get(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function logs()
    {
        // Activity logs monitoring (mocked for now)
        $logs = [
            ['time' => now()->subMinutes(5), 'user' => 'System', 'activity' => 'Database backup completed.'],
            ['time' => now()->subMinutes(15), 'user' => 'Admin', 'activity' => 'Updated Developer template.'],
            ['time' => now()->subMinutes(30), 'user' => 'John Doe', 'activity' => 'Generated a new resume.'],
        ];
        return view('admin.logs', compact('logs'));
    }

    public function templates()
    {
        return view('admin.templates');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return back()->with('success', 'User account deleted successfully.');
    }
}
