<?php

namespace App\Services;

use App\Models\LeaveRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminLeaveRequestService
{
    private const PER_PAGE = 10;

    public function getFilteredRequests(array $filters): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $status = $filters['status'] ?? null;
        $sort   = $filters['sort'] ?? 'newest';

        return LeaveRequest::query()
            ->with('user') // eager load to avoid N+1 when the view reads $request->user->name/email
            ->when($search, function ($query, string $search) {
            $query->where(function ($query) use ($search) {
            $query->where('reason', 'like', "%{$search}%")
            ->orWhereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->when($status, fn ($query, string $status) => $query->where('status', $status))
            ->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(self::PER_PAGE)
            ->withQueryString();
    }
}
