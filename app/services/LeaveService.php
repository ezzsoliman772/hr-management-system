<?php

namespace App\Services;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class LeaveService
{
    public function createLeaveRequest(array $data, int $userId)
{
    $user = User::findOrFail($userId);
    $days = $this->calculateLeaveDays(
        $data['start_date'],
        $data['end_date']
    );
    $this->ensureEnoughBalance($user, $days);
    return $this->storeLeaveRequest(
        $data,
        $userId,
        $days
    );
}
private function calculateLeaveDays($startDate, $endDate): int
{
       return Carbon::parse($startDate)
       ->diffInDays(Carbon::parse($endDate)) + 1;
}
private function ensureEnoughBalance(User $user, int $days): void
{
    if ($days > $user->annual_leave_balance) {
        throw ValidationException::withMessages([
            'leave_balance' => 'You do not have enough leave balance.',
        ]);
    }
}
private function storeLeaveRequest(array $data, int $userId, int $days)
{
   $leave = LeaveRequest::create([
    'user_id' => $userId,
    'start_date' => $data['start_date'],
    'end_date' => $data['end_date'],
    'days' => $days,
    'reason' => $data['reason'],
    'status' => 'pending',
]);

}
}