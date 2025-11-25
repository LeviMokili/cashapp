<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataConfirmation;
use App\Http\Controllers\DataEntry;
use App\Http\Controllers\TransferController;
use App\Models\Transfer;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.get');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isUser1()) {
            return redirect('/user1/dashboard');
        } elseif ($user->isUser2()) {
            return redirect('/user2/dashboard');
        }

        return redirect('/login');
    });

    // Admin Routes - Updated to use home.blade.php
    Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/manage-users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/view-logs', [AdminController::class, 'index'])->name('admin.logs.index');
    Route::get('/manage-transfers', [TransferController::class, 'index'])->name('admin.transfers.index');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/logs', [AdminController::class, 'loadlogs'])->name('admin.logs');
    Route::get('/dashboard/chart-data', [AdminController::class, 'getChartDataAjax'])->name('admin.dashboard.chartData');


    // Employee management routes
    Route::get('users/list', [AdminController::class, 'userslist'])->name('users.list');
    Route::post('/employees', [AdminController::class, 'addEmployee'])->name('employee.add');
    Route::get('/employees/{id}', [AdminController::class, 'getEmployee'])->name('employee.get');
    Route::put('/employees/{id}', [AdminController::class, 'updateEmployee'])->name('employee.update');
    Route::delete('/employees/{id}', [AdminController::class, 'deleteEmployee'])->name('employee.delete');
});

    // User1 Routes - Updated to use home.blade.php
    Route::prefix('user1')->middleware('user1')->group(function () {
        Route::get('/transfer/create/page', [DataEntry::class, 'dashboard'])->name('hr.leave.employee.page');
        Route::get('create/leave/employee/page', [DataEntry::class, 'createLeaveEmployee'])
            ->name('hr.LeavesManage.create-leave-employee');

        Route::get('/transfers/{transfer}/edit', [TransferController::class, 'edit'])->name('transfers.edit');

        Route::post('create/leave/employee/page', [TransferController::class, 'store'])
            ->name('hr.LeavesManage.create-leave-employee');

        Route::post('update/leave/employee/page/{transfer}', [TransferController::class, 'update'])
            ->name('transfers.update');
        Route::get('/transfers/{transfer}', [TransferController::class, 'show'])->name('transfers.show');


        Route::get('/get-reference-code', [TransferController::class, 'getReferenceCode'])->name('transfers.get-reference');




    });

    Route::prefix('user2')->middleware('user2')->group(function () {
        Route::get('/dataconfirmation', [DataConfirmation::class, 'dashboard'])->name('DataConfirmation.dashboard');
        Route::post('/transfers/{id}/update-status', [TransferController::class, 'updateStatus'])->name('transfers.updateStatus');
        // ... other routes
    });

});




// Route::get('/', function () {
//     return view('dashboard.home'); // Points to dashboard/home.blade.php
// });