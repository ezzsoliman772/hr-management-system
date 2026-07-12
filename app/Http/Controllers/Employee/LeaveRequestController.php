<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Controllers\Controller;

use App\Services\LeaveService;
use App\Services\EmployeeService;

class LeaveRequestController extends Controller
{
    public function __construct(
    private LeaveService $leaveService,
    private EmployeeService $employeeService
    ) 
    {

    } 
    
public function create()
{
    $remainingDays = $this->employeeService->getRemainingBalance(Auth::user());
    return view('employee.leave-request.create', compact('remainingDays'));
}

public function store(StoreLeaveRequest $request)
{
    $this->leaveService->createLeaveRequest(
    $request->validated(),
    Auth::id()
    );

    return redirect()
        ->route('employee.dashboard')
        ->with('success', 'Leave request submitted successfully.');
}
}

