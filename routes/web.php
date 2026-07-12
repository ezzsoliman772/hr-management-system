<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
//
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\LeaveRequestController;
use App\Http\Controllers\Employee\HistoryRequestController;

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LeaveRequestController as AdminLeaveRequestController;

// landing page
Route::get('/', function () { return view('welcome');});

//Employee Routes
Route::middleware(['auth', 'role:employee'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('employee.dashboard');

    Route::get('/leave-requests', [HistoryRequestController::class, 'index'])
        ->name('leaves.index');

    Route::get('/leave-request/create', [LeaveRequestController::class, 'create'])
        ->name('leave-requests.create');

    Route::post('/leave-request', [LeaveRequestController::class, 'store'])
        ->name('leave-requests.store');

});

//Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/employees',[EmployeeController::class,'index'])
        ->name('admin.employees.index');

    Route::get('/admin/leave-requests', [AdminLeaveRequestController::class, 'index'])
        ->name('admin.leave-requests.index');
    
    Route::post('/admin/requests/{leaveRequest}/approve',[AdminLeaveRequestController::class, 'approve']) 
        ->name('admin.requests.approve');

    Route::post('/admin/requests/{leaveRequest}/reject',[AdminLeaveRequestController::class, 'reject'])
        ->name('admin.requests.reject');

    Route::patch('/admin/employees/{user}',[EmployeeController::class, 'update'])
        ->name('admin.employees.update');
});

require __DIR__.'/auth.php';
