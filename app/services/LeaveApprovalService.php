<?php

namespace App\Services;

use App\Models\LeaveRequest;
use Illuminate\Validation\ValidationException;

class LeaveApprovalService
{
    public function approve(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->status !== 'pending') {
            throw ValidationException::withMessages([
            'status' => 'This request has already been processed.'
            ]);
        }

        $user = $leaveRequest->user;
        $user->annual_leave_balance -= $leaveRequest->days;
        $user->save();
        $leaveRequest->status = 'approved';
        $leaveRequest->save();
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->status !== 'pending') {
            throw ValidationException::withMessages([
            'status' => 'This request has already been processed.'
            ]);
        }

        $leaveRequest->status = 'rejected';
        $leaveRequest->save();
    }
}