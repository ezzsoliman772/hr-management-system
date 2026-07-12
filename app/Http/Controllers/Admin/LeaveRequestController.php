<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLeaveRequestFilterRequest;
use App\Models\LeaveRequest;
use App\Services\LeaveApprovalService;
use App\Services\AdminLeaveRequestService;
use Illuminate\View\View;
class LeaveRequestController extends Controller
{
    public function __construct(
        private LeaveApprovalService $leaveApprovalService,
        private readonly AdminLeaveRequestService $adminLeaveRequestService
    ) {}

    public function index(AdminLeaveRequestFilterRequest $request): View
    {
        $filters = $request->filters();

        $requests = $this->adminLeaveRequestService->getFilteredRequests($filters);

        return view('admin.index', [
            'requests' => $requests,
            'search'   => $filters['search'],
            'status'   => $filters['status'],
            'sort'     => $filters['sort'],
        ]);
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        $this->leaveApprovalService->approve($leaveRequest);

        return back()->with('success', 'Leave request approved successfully.');
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        $this->leaveApprovalService->reject($leaveRequest);

        return back()->with('success', 'Leave request rejected successfully.');
    }
}