<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;

class DataEntry extends Controller
{
  //
  public function dashboard()
  {

    $transfers = Transfer::where('created_by', auth()->id())
      ->latest()
      ->get();
    $todayAmount = Transfer::whereDate('date_transfer', today())
      ->sum('amount');
    $totalUsers = User::count();
    $pendingTransfers = Transfer::whereDate('date_transfer', today())->where('status', 'Pending')->count();
    $completedTransfers = Transfer::whereDate('date_transfer', today())->where('status', 'Confirmed')->count();
    $cancelledTransfers = Transfer::whereDate('date_transfer', today())->where('status', 'Declined')->count();


    return view('HR.LeavesManage.leave-employee', compact(
      'transfers',
      'todayAmount',
      'totalUsers',
      'pendingTransfers',
      'completedTransfers',
      'cancelledTransfers'
    ));

  }

  public function createLeaveEmployee()
  {
    return view('HR.LeavesManage.create-leave-employee');
  }

}
