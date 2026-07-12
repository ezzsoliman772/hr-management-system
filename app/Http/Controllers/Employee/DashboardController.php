<?php

namespace App\Http\Controllers\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
        public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }
    public function index()
    {
        $user = auth()->user();
        $usedDays       = $this->employeeService->getUsedDays($user);
        $totalAllowance = $this->employeeService->getTotalAllowance($user);
        $remainingBalance = $this->employeeService->getRemainingBalance($user);


        $leaveRequests = $user->leaveRequests()->latest()->paginate(10);

        $pendingCount = $leaveRequests->where('status', 'pending')->count();
        $approvedCount = $leaveRequests->where('status', 'approved')->count();
        $rejectedCount = $leaveRequests->where('status', 'rejected')->count();

        $recentRequests = $leaveRequests->take(5);

        return view('employee.dashboard',
         compact('user',
            'leaveRequests',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'recentRequests',  
            'usedDays',
            'totalAllowance',
            'remainingBalance'
            ));
            
    }


     
}