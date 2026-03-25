<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resume;
use App\Models\ActivityLog;
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
        $logs = ActivityLog::with('user')->latest()->get()->map(function ($log) {
            return [
                'time' => $log->created_at,
                'user' => $log->user ? $log->user->name : 'System',
                'activity' => $log->activity,
            ];
        });
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

        $userName = $user->name;
        $user->delete();
        ActivityLog::record("Deleted user account for {$userName}.");

        return back()->with('success', 'User account deleted successfully.');
    }
}
