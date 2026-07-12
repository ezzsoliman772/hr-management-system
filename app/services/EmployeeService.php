<?php

namespace App\Services;

use App\Models\LeaveRequest;
use App\Models\User;





class EmployeeService
{
    public function updateBalance(User $user, int $newAllowance): void
    {
        $usedDays = $user->annual_leave_allowance - $user->annual_leave_balance;
       if ($newAllowance < $usedDays) {
    throw ValidationException::withMessages([
        'leave_balance' => 'Annual allowance cannot be less than used leave days.',
    ]);
}
        $user->annual_leave_allowance = $newAllowance;
        $user->annual_leave_balance = max($newAllowance - $usedDays,0);

        $user->save();
    }

    public function getTotalAllowance(User $user): int
    {
        return $user->annual_leave_allowance ?? 0;
    }

    public function getUsedDays(User $user): int
    {
        return LeaveRequest::where('user_id', $user->id)
                           ->where('status', 'approved')
                           ->sum('days') ?? 0;
    }

    public function getRemainingBalance(User $user): int
    {
        return $user->annual_leave_balance; 
    }
    
}