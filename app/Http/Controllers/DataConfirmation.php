<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;

class DataConfirmation extends Controller
{
    public function dashboard()
    {

        $transfers = Transfer::latest()->get();
        $todayAmount = Transfer::whereDate('date_transfer', today())
            ->sum('amount');

            
        $totalUsers = User::count();
        $pendingTransfers = Transfer::where('status', 'Pending')->count();
        $completedTransfers = Transfer::where('status', 'Confirmed')->count();


        return view('DataConfirmation.dashboard', compact(
            'transfers',
            'todayAmount',
            'totalUsers',
            'pendingTransfers',
            'completedTransfers'
        ));

    }


}
