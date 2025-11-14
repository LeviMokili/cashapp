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
       $pendingTransfers = Transfer::where('status', 'Pending')->count();
      $completedTransfers = Transfer::where('status', 'Confirmed')->count();


       return view('HR.LeavesManage.leave-employee' ,compact(
        'transfers',
        'todayAmount',
        'totalUsers',
        'pendingTransfers',
        'completedTransfers'
      ));

    }

    public function createLeaveEmployee(){
        return view('HR.LeavesManage.create-leave-employee');
    }
    
}
