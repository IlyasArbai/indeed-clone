<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->data;

        $applicants = $user->applicants()
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => $user->applicants()->count(),
            'pending' => $user->applicants()->where('status', 'pending')->count(),
            'hired' => $user->applicants()->where('status', 'hired')->count(),
            'rejected' => $user->applicants()->where('status', 'rejected')->count(),
        ];

        return view('dashboard.user', compact('applicants', 'stats', 'user'));
    }
}
