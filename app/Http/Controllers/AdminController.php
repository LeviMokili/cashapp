<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Transfer;
use App\Models\User;
use DateTime;
use Flasher\Prime\Storage\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Get filter parameters
        $period = $request->get('period', 'daily');
        $selectedYear = $request->get('year');
        $selectedMonth = $request->get('month');
        $selectedWeek = $request->get('week');

        // Statistics
        $totalTransfers = Transfer::whereDate('date_transfer', today())->where('status', 'Confirmed')->count();
        $pendingTransfers = Transfer::whereDate('date_transfer', today())->where('status', 'Pending')->count();
        $completedTransfers = Transfer::whereDate('date_transfer', today())->where('status', 'Confirmed')->count();
        $rejectedTransfers = Transfer::whereDate('date_transfer', today())->where('status', 'Cancelled')->count();
        $totalUsers = User::count();
        $totalMoney = Transfer::whereDate('date_transfer', today())->where('status', 'Confirmed')->sum('amount');



        $transfers = Transfer::whereDate('date_transfer', today())->where('status', 'Confirmed')->latest()->get();



        $todayAmount = Transfer::whereDate('date_transfer', today())
            ->sum('amount');
        // Today's transfer amount
        $todayAmount = Transfer::whereDate('date_transfer', today())
            ->where('status', 'Confirmed')
            ->sum('amount');

        // Get available years for dropdown
        $availableYears = $this->getAvailableYears();

        // Initialize chart data
        $labels = [];
        $amounts = [];
        $chartTitle = 'Select filters to view chart';
        $showChart = false;

        // Only show chart if required filters are selected
        if ($this->hasRequiredFilters($period, $selectedYear, $selectedMonth, $selectedWeek)) {
            $chartData = $this->getChartData($period, $selectedYear, $selectedMonth, $selectedWeek);
            $labels = $chartData['labels'];
            $amounts = $chartData['data'];
            $chartTitle = $chartData['title'];
            $showChart = true;
        }

        // Get available months and weeks based on selected year
        $availableMonths = $selectedYear ? $this->getAvailableMonths($selectedYear) : [];
        $availableWeeks = ($selectedYear && $selectedMonth) ? $this->getAvailableWeeks($selectedYear, $selectedMonth) : [];



        $recentTransfers = Transfer::latest()
            ->limit(10)
            ->get();

        return view('dashboard.home', compact(
            'totalTransfers',
            'pendingTransfers',
            'completedTransfers',
            'rejectedTransfers',
            'totalUsers',
            'todayAmount',
            'labels',
            'amounts',
            'recentTransfers',
            'period',
            'selectedYear',
            'selectedMonth',
            'selectedWeek',
            'chartTitle',
            'availableYears',
            'availableMonths',
            'availableWeeks',
            'showChart',
            'transfers',
            'totalMoney'
        ));
    }

    private function hasRequiredFilters($period, $year, $month, $week)
    {
        return match ($period) {
            'daily' => !empty($year) && !empty($month),
            'weekly' => !empty($year) && !empty($month) && !empty($week),
            'monthly' => !empty($year) && !empty($month),
            'yearly' => !empty($year),
            default => false
        };
    }

    private function getAvailableYears()
    {
        return Transfer::select(DB::raw('YEAR(date_transfer) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();
    }

    private function getAvailableMonths($year)
    {
        $months = Transfer::select(DB::raw('MONTH(date_transfer) as month'))
            ->whereYear('date_transfer', $year)
            ->distinct()
            ->orderBy('month')
            ->pluck('month')
            ->toArray();

        // Convert month numbers to names
        $monthNames = [];
        foreach ($months as $month) {
            $monthNames[$month] = DateTime::createFromFormat('!m', $month)->format('F');
        }

        return $monthNames;
    }

    private function getAvailableWeeks($year, $month)
    {
        // Get all unique dates with transfers in this month
        $dates = Transfer::select(DB::raw('DATE(date_transfer) as date'))
            ->whereYear('date_transfer', $year)
            ->whereMonth('date_transfer', $month)
            ->where('status', 'Confirmed')
            ->distinct()
            ->orderBy('date')
            ->pluck('date')
            ->toArray();

        $weeks = [];

        foreach ($dates as $date) {
            $carbonDate = Carbon::parse($date);
            $day = $carbonDate->day;

            // Calculate week of month (1-5)
            $weekOfMonth = ceil($day / 7);

            if (!in_array($weekOfMonth, $weeks)) {
                $weeks[] = $weekOfMonth;
            }
        }

        sort($weeks);
        return $weeks;
    }
    private function getChartData($period, $year, $month, $week)
    {
        switch ($period) {
            case 'daily':
                return $this->getDailyData($year, $month);
            case 'weekly':
                return $this->getWeeklyData($year, $month, $week);
            case 'monthly':
                return $this->getMonthlyData($year, $month);
            case 'yearly':
                return $this->getYearlyData($year);
            default:
                return $this->getDailyData($year, $month);
        }
    }

    private function getDailyData($year, $month)
    {
        $start = Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();
        $title = "Daily Transfers for {$start->format('F Y')}";

        $data = Transfer::select(
            DB::raw('DAY(date_transfer) as day'),
            DB::raw('DATE_FORMAT(date_transfer, "%b %d") as day_label'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->whereYear('date_transfer', $year)
            ->whereMonth('date_transfer', $month)
            ->where('status', 'Confirmed')
            ->groupBy('day', 'day_label')
            ->orderBy('day')
            ->get();

        return $this->fillDailyGaps($data, $start, $end, $title);
    }

    private function getWeeklyData($year, $month, $week)
    {
        $monthName = DateTime::createFromFormat('!m', $month)->format('F');
        $title = "Week $week Transfers for {$monthName} {$year}";

        // Calculate the exact date range for the selected week
        $firstDayOfMonth = Carbon::create($year, $month, 1);

        // Calculate start of the selected week (1st week = days 1-7, 2nd week = days 8-14, etc.)
        $startDay = (($week - 1) * 7) + 1;
        $startOfWeek = Carbon::create($year, $month, $startDay);

        // Calculate end of week (7 days later, but don't exceed month end)
        $endOfWeek = $startOfWeek->copy()->addDays(6);
        $endOfMonth = $firstDayOfMonth->copy()->endOfMonth();

        if ($endOfWeek > $endOfMonth) {
            $endOfWeek = $endOfMonth;
        }

        // Debug: Log the date range
        \Log::info("Weekly chart range: {$startOfWeek->toDateString()} to {$endOfWeek->toDateString()}");

        // Get data for this week
        $data = Transfer::select(
            DB::raw('DATE(date_transfer) as date'),
            DB::raw('DAY(date_transfer) as day'),
            DB::raw('DATE_FORMAT(date_transfer, "%b %d") as day_label'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->whereBetween('date_transfer', [$startOfWeek, $endOfWeek])
            ->where('status', 'Confirmed')
            ->groupBy('date', 'day', 'day_label')
            ->orderBy('date')
            ->get();

        // Debug: Log found data
        \Log::info("Weekly data found: " . $data->count() . " records");

        $labels = [];
        $amounts = [];

        // Fill all days in the week range
        $current = $startOfWeek->copy();
        while ($current <= $endOfWeek) {
            $label = $current->format('M d');

            // Find data for this specific date
            $dateData = $data->firstWhere('date', $current->format('Y-m-d'));

            $labels[] = $label;
            $amounts[] = $dateData ? (float) $dateData->total_amount : 0;

            $current->addDay();
        }

        return [
            'labels' => $labels,
            'data' => $amounts,
            'title' => $title
        ];
    }
    private function getMonthlyData($year, $month)
    {
        $monthName = DateTime::createFromFormat('!m', $month)->format('F');
        $title = "Monthly Transfers for {$monthName} {$year}";

        // Get total amount for the selected month
        $totalAmount = Transfer::whereYear('date_transfer', $year)
            ->whereMonth('date_transfer', $month)
            ->where('status', 'Confirmed')
            ->sum('amount');

        // For monthly view, we show a single bar for the selected month
        return [
            'labels' => [$monthName],
            'data' => [(float) $totalAmount],
            'title' => $title
        ];
    }

    private function getYearlyData($year)
    {
        $title = "Yearly Transfers for {$year}";

        // Get total amount for the selected year
        $totalAmount = Transfer::whereYear('date_transfer', $year)
            ->where('status', 'Confirmed')
            ->sum('amount');

        // For yearly view, we show a single bar for the selected year
        return [
            'labels' => [$year],
            'data' => [(float) $totalAmount],
            'title' => $title
        ];
    }

    private function fillDailyGaps($data, $start, $end, $title)
    {
        $labels = [];
        $amounts = [];

        $daysInMonth = $end->day;

        // Create array for all days in month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = Carbon::create($start->year, $start->month, $day);
            $label = $currentDate->format('M d');

            // Find data for this specific day
            $dayData = $data->firstWhere('day', $day);

            $labels[] = $label;
            $amounts[] = $dayData ? (float) $dayData->total_amount : 0;
        }

        return [
            'labels' => $labels,
            'data' => $amounts,
            'title' => $title
        ];
    }



    public function loadlogs()
    {
        $logs = AuditLog::latest()->paginate(20);
        return view('dashboard.logs', compact('logs'));
    }






    public function userslist()
    {
        $userslist = User::all();
        return view('dashboard.users', compact('userslist'));
    }

    // Add new employee
    public function addEmployee(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'joinDate' => 'required',
        'status' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    try {
        // ✅ Step 1: Create user (so we get auto-increment ID)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'), // Default password
            'role' => $request->role,
            'location' => $request->location,
            'joinDate' => $request->joinDate,
            'status' => $request->status,
            'phone' => $request->phone,
        ]);

        // ✅ Step 2: Generate unique employee code
        $employeeId = 'EMP' . str_pad($user->id, 4, '0', STR_PAD_LEFT);

        // ✅ Step 3: Update the employee record
        $user->update(['employee_id' => $employeeId]);

        return redirect()->back()->with('success', "Employee added successfully with ID: {$employeeId}");

    } catch (\Exception $e) {
        // ✅ Step 4: Handle any errors gracefully
        return redirect()->back()->with('error', 'Failed to add employee: ' . $e->getMessage());
    }
}

    // Get employee data for editing
    public function getEmployee($id)
    {
        $employee = User::findOrFail($id);
        return response()->json($employee);
    }

    // Update employee
    public function updateEmployee(Request $request, $id)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'joinDate' => 'required',
            'status' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

         $credentials['status'] = 'active';

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);

            // Update user data
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'location' => $request->location,
                'joinDate' => $request->joinDate,
                'status' => $request->status,
                'phone' => $request->phone,
            ]);

            DB::commit();

            return redirect()->route('users.list')->with('success', 'Employee updated successfully!');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to update employee: ' . $e->getMessage());
        }
    }

    // Delete employee
    public function deleteEmployee($id)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();

            return redirect()->route('users.list')->with('success', 'Employee deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }
}