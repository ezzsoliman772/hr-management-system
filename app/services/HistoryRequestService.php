<?php

namespace App\Services;

use App\Models\User;

class HistoryRequestService
{
    public function getUserRequests(User $user, ?string $status = null)
    {
        $query = $user->leaveRequests()->latest();

    if ($status) {
        $query->where('status', $status);
    }

    return $query->paginate(10)->withQueryString();
    }
}