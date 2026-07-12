<?php

namespace App\Http\Controllers\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HistoryRequestService;
use App\Http\Requests\Employee\HistoryRequestFilterRequest;
class HistoryRequestController extends Controller
{
     public function __construct(
     protected HistoryRequestService $historyRequestService
    ) 
    {}

    public function index(HistoryRequestFilterRequest $request)
    {

    $statusFilter = $request->validated('status');
    $requests = $this->historyRequestService
            ->getUserRequests(auth()->user(), $statusFilter);

        return view('employee.myrequests', compact('requests', 'statusFilter'));
    }
}
