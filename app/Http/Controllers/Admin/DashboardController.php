<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = User::where('role', 'employee')->count();

        $pendingCount = LeaveRequest::where('status', 'pending')->count();

        $approvedThisMonth = LeaveRequest::where('status', 'approved')
            ->whereMonth('updated_at', now()->month)
            ->count();

        $rejectedCount = LeaveRequest::where('status', 'rejected')->count();

        $requests = LeaveRequest::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.dashboard', compact(
            'totalEmployees',
            'pendingCount',
            'approvedThisMonth',
            'rejectedCount',
            'requests'
        ));
    }
}