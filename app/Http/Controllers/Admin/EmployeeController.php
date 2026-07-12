<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\UpdateEmployeeBalanceRequest;
use App\Services\EmployeeService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $employeeService
    ) {}

     public function index()
    {
        $employees = User::where('role', 'employee')
            ->paginate(10);

        return view('admin.employees', compact('employees'));
    }

    public function update(UpdateEmployeeBalanceRequest $request, User $user)
{
    $this->employeeService->updateBalance(
        $user,
        $request->validated()['leave_balance']
    );

    return back()->with('success', 'Employee balance updated successfully.');
}
}
