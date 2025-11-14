<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'ville_provenance' => 'required|string|max:255',
            'ville_destination' => 'required|string|max:255',
            'guichetier_provenance' => 'required|string|max:255',
            'guichetier_destination' => 'required|string|max:255',
            'date_transfer' => 'required|date',
            'telephone' => 'required|string|max:20',
        ]);

        $referenceCode = $this->generateReferenceCode($validated['date_transfer']);
        Transfer::create([
            'reference_code' => $referenceCode,
            'sender_name' => $validated['sender_name'],
            'receiver_name' => $validated['receiver_name'],
            'amount' => $validated['amount'],
            'ville_provenance' => $validated['ville_provenance'],
            'ville_destination' => $validated['ville_destination'],
            'guichetier_provenance' => $validated['guichetier_provenance'],
            'guichetier_destination' => $validated['guichetier_destination'],
            'date_transfer' => $validated['date_transfer'],
            'telephone' => $validated['telephone'],
            'status' => 'Pending',
            'created_by' => auth()->id(),
        ]);


        // Log the transfer creation

        AuditLog::create([
            'status' => 'Pending',
            'perfomed_by' => Auth::user()->name,
            'transfer_code' => $referenceCode,
            'amount' => $validated['amount']
        ]);

        return redirect()->route('hr.leave.employee.page')
            ->with('success', 'Transfer created successfully!');


    }


    private function generateReferenceCode($date)
    {
        $date = Carbon::parse($date);

        // Format: YYMMDD (last 2 digits of year, month, day)
        $datePart = $date->format('ymd'); // This gives "251106" for 2025-11-06

        // Count how many transfers already exist for this date
        $count = Transfer::whereDate('date_transfer', $date->format('Y-m-d'))->count();

        // Increment count by 1 for the new transfer
        $sequenceNumber = $count + 1;

        // Format: YYMMDD + N + sequence number (251106N1, 251106N2, etc.)
        return $datePart . 'N' . $sequenceNumber;
    }


    // AJAX method to get reference code for a selected date
    public function getReferenceCode(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $referenceCode = $this->generateReferenceCode($request->date);

        return response()->json(['reference_code' => $referenceCode]);
    }


    public function edit($id)
    {
        $transfer = Transfer::where('created_by', auth()->id())->findOrFail($id);
        return view('hr.LeavesManage.edit-leave-employee', compact('transfer'));
    }


    public function update(Request $request, Transfer $transfer)
    {
        // Check if the transfer belongs to the current user
        if ($transfer->created_by !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'date_transfer' => 'required|date',
            'sender_name' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'ville_provenance' => 'required|string|max:255',
            'ville_destination' => 'required|string|max:255',
            'guichetier_provenance' => 'required|string|max:255',
            'guichetier_destination' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'telephone' => 'required|string|max:20',

        ]);


        try {
            $transfer->update($validated);

            return redirect()->route('hr.leave.employee.page', $transfer)
                ->with('success', 'Transfer updated successfully!');

        } catch (\Exception $e) {
            return redirect()->route('transfers.edit', $transfer)
                ->with('error', 'Error updating transfer: ' . $e->getMessage())
                ->withInput();
        }
    }



    public function show($id)
    {
        $transfer = Transfer::where('created_by', auth()->id())->findOrFail($id);
        return view('hr.LeavesManage.show', compact('transfer'));
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            $transfer = Transfer::findOrFail($id);

            // Add authorization check - adjust based on your user roles
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.',
                ], 403);
            }

            $oldStatus = $transfer->status;
            $newStatus = $request->input('status');

            if (!in_array($newStatus, ['Pending', 'Confirmed', 'Cancelled'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status value.',
                ], 400);
            }

           
            $transfer->status = $newStatus;
            $transfer->save();

            return response()->json([
                'success' => true,
                'message' => 'Transfer status updated successfully.',
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ]);
        } catch (\Exception $e) {
            \Log::error('Status update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

}
