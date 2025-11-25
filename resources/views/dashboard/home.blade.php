@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">ADMIN</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">ADMIN</li>
                </ul>
            </div>
            <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                <div class="col-span-12 md:order-1 xl:col-span-8 2xl:col-span-6">
                    
                </div>

                <div class="col-span-12 md:order-3 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Total Transfer</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value"
                                        data-target="{{ $totalTransfers }}">0</span></h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="totalEmployee" data-chart-colors='["bg-custom-500"]' dir="ltr"
                                    class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200 grow"><span
                                    class="font-medium text-green-500">15%</span> Increase</p>
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:order-3 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Total Today Money</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value" data-target="{{ $totalMoney }}">0</span>$
                                </h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="totalEmployee" data-chart-colors='["bg-custom-500"]' dir="ltr"
                                    class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200 grow"><span
                                    class="font-medium text-green-500">15%</span> Increase</p>
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:order-4 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Pending</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value"
                                        data-target="{{ $pendingTransfers }}">0</span></h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="totalApplication" data-chart-colors='["bg-purple-500"]' dir="ltr"
                                    class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200 grow"><span
                                    class="font-medium text-green-500">26%</span> Increase</p>
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:order-7 2xl:order-5 lg:col-span-12 2xl:col-span-6 2xl:row-span-2 card">
                    <div class="card-body">
                        <!-- Chart Filters -->
                        <div class="chart-filters mb-4">
                            <form method="GET" action="{{ route('admin.dashboard') }}" class="period-filter-form">
                                <!-- Period Type Selection -->
                                <div class="filter-section mb-4">
                                    <h6 class="text-15 mb-2">📊 Select Chart Type:</h6>
                                    <div class="filter-row">
                                        <div class="filter-group">
                                            <label
                                                class="block text-sm font-medium text-slate-500 dark:text-zink-200 mb-1">Period
                                                Type:</label>
                                            <select name="period" onchange="this.form.submit()"
                                                class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                <option value="">Select Period Type</option>
                                                <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Daily View
                                                </option>
                                                <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>Weekly View
                                                </option>
                                                <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Monthly
                                                    View</option>
                                                <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Yearly View
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Filters Based on Period Type -->
                                @if($period)
                                    <div class="filter-section">
                                        <h6 class="text-15 mb-2">🎯 Select Time Period:</h6>
                                        <div class="filter-row flex flex-wrap gap-4">
                                            <!-- Year Selection (Required for all types) -->
                                            <div class="filter-group">
                                                <label
                                                    class="block text-sm font-medium text-slate-500 dark:text-zink-200 mb-1">Year:</label>
                                                <select name="year" onchange="this.form.submit()"
                                                    class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                    <option value="">Select Year</option>
                                                    @foreach($availableYears as $year)
                                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                                            {{ $year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Month Selection (Required for Daily, Weekly, Monthly) -->
                                            @if(in_array($period, ['daily', 'weekly', 'monthly']) && $selectedYear)
                                                <div class="filter-group">
                                                    <label
                                                        class="block text-sm font-medium text-slate-500 dark:text-zink-200 mb-1">Month:</label>
                                                    <select name="month" onchange="this.form.submit()"
                                                        class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                        <option value="">Select Month</option>
                                                        @foreach($availableMonths as $monthNum => $monthName)
                                                            <option value="{{ $monthNum }}" {{ $selectedMonth == $monthNum ? 'selected' : '' }}>
                                                                {{ $monthName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif

                                            <!-- Week Selection (Required for Weekly only) -->
                                            @if($period == 'weekly' && $selectedYear && $selectedMonth)
                                                <div class="filter-group">
                                                    <label
                                                        class="block text-sm font-medium text-slate-500 dark:text-zink-200 mb-1">Week:</label>
                                                    <select name="week" onchange="this.form.submit()"
                                                        class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200">
                                                        <option value="">Select Week</option>
                                                        @foreach($availableWeeks as $week)
                                                            <option value="{{ $week }}" {{ $selectedWeek == $week ? 'selected' : '' }}>
                                                                Week {{ $week }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>

                        <!-- Chart Container -->
                        <div class="chart-container">
                            <h6 class="text-15 mb-3">{{ $chartTitle ?? 'Transfer Analytics' }}</h6>

                            @if($showChart)
                                <div id="transferChart" class="apex-charts" dir="ltr"></div>
                            @else
                                <div
                                    class="chart-placeholder flex flex-col items-center justify-center h-64 text-slate-500 dark:text-zink-200">
                                    <div class="no-chart-message text-center">
                                        <i class="fas fa-chart-bar text-5xl mb-4 opacity-50"></i>
                                        <p>Please select the required filters above to view the chart</p>
                                        @if($period == 'daily')
                                            <small class="text-sm mt-2">Required: Year + Month</small>
                                        @elseif($period == 'weekly')
                                            <small class="text-sm mt-2">Required: Year + Month + Week</small>
                                        @elseif($period == 'monthly')
                                            <small class="text-sm mt-2">Required: Year + Month</small>
                                        @elseif($period == 'yearly')
                                            <small class="text-sm mt-2">Required: Year</small>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Rest of your existing code remains the same -->
                <div class="col-span-12 md:order-5 2xl:order-6 lg:col-span-6 2xl:col-span-3 card">
                    <div class="card-body">
                        <div class="grid grid-cols-12">
                            <div class="col-span-8 md:col-span-9">
                                <p class="text-slate-500 dark:text-slate-200">Confirmed</p>
                                <h5 class="mt-3 mb-4"><span class="counter-value"
                                        data-target="{{ $completedTransfers  }}">0</span></h5>
                            </div>
                            <div class="col-span-4 md:col-span-3">
                                <div id="hiredCandidates" data-chart-colors='["bg-green-500"]' dir="ltr"
                                    class="grow apex-charts"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 mt-3">
                            <p class="text-slate-500 dark:text-slate-200 grow"><span
                                    class="font-medium text-red-500">05%</span> Increase</p>
                            <p class="text-slate-500 dark:text-slate-200">This Month</p>
                        </div>
                    </div>
                </div>
                <!-- ... rest of your existing code ... -->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="grid grid-cols-1 gap-4 mb-5 lg:grid-cols-2 xl:grid-cols-12">
                    <div class="xl:col-span-6">
                        <h6 class="text-15 grow">Recent Transfers</h6>
                    </div>
                    <div class="xl:col-span-6">
                        <div class="flex flex-wrap gap-2 xl:justify-end">
                            <!-- Print Button -->
                            <button type="button" id="printButton"
                                class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 dark:ring-custom-400/20">
                                <i class="fas fa-print mr-1"></i> Print
                            </button>

                            <!-- PDF Button -->
                            <button type="button" id="pdfButton"
                                class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 dark:bg-red-500/20 dark:text-red-400 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                                <i class="fas fa-file-pdf mr-1"></i> PDF
                            </button>

                            <!-- Excel Button -->
                            <button type="button" id="excelButton"
                                class="text-green-500 bg-green-100 btn hover:text-white hover:bg-green-600 focus:text-white focus:bg-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500 dark:hover:text-white dark:focus:bg-green-500 dark:focus:text-white dark:active:bg-green-500 dark:active:text-white dark:ring-green-400/20">
                                <i class="fas fa-file-excel mr-1"></i> Excel
                            </button>

                            <!-- CSV Button -->
                            <button type="button" id="csvButton"
                                class="text-purple-500 bg-purple-100 btn hover:text-white hover:bg-purple-600 focus:text-white focus:bg-purple-600 focus:ring focus:ring-purple-100 active:text-white active:bg-purple-600 dark:bg-purple-500/20 dark:text-purple-400 dark:hover:bg-purple-500 dark:hover:text-white dark:focus:bg-purple-500 dark:focus:text-white dark:active:bg-purple-500 dark:active:text-white dark:ring-purple-400/20">
                                <i class="fas fa-file-csv mr-1"></i> CSV
                            </button>
                        </div>
                    </div>
                </div>

              


                 <table id="alternativePagination" class="display" style="width:100%">
                        <thead>
                             <tr>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">No</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Date</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Reference
                                Code</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Sender
                                Name</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Receiver
                                Name</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">City From
                            </th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">City To
                            </th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                Guichetier de provenance</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                Guichetier de destination</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Telephone
                            </th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Status
                            </th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Amount
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                          @foreach($transfers as $key => $value)
                            <tr>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ ++$key }}</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->date_transfer->format('D-m-Y')  }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"
                                    style="font-weight:700">
                                    {{ $value->reference_code }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->sender_name }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->receiver_name }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->ville_provenance }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->ville_destination }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->guichetier_provenance }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->guichetier_destination }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->telephone }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    @if($value->status == 'Confirmed')
                                        <span
                                            class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">{{ $value->status }}</span>
                                    @elseif($value->status == 'Pending')
                                        <span
                                            class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">{{ $value->status }}</span>
                                    @elseif($value->status == 'Declined')
                                        <span
                                            class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">{{ $value->status }}</span>
                                    @else
                                    @endif
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ number_format($value->amount, 2)  }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>


        
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @if($showChart)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartElement = document.getElementById('transferChart');
                if (!chartElement) return;

                const labels = @json($labels ?? []);
                const amounts = @json($amounts ?? []);
                const chartTitle = @json($chartTitle ?? 'Transfer Analytics');

                // ApexCharts configuration
                const options = {
                    series: [{
                        name: 'Transfer Amount (USD)',
                        data: amounts
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: false,
                            columnWidth: '70%',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: labels,
                        title: {
                            text: 'Period'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Amount (USD)'
                        },
                        min: 0
                    },
                    fill: {
                        opacity: 1,
                        colors: ['#3B82F6'] // Using a blue color that matches your theme
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "$" + val.toLocaleString()
                            }
                        }
                    },
                    title: {
                        text: chartTitle,
                        align: 'center',
                        style: {
                            fontSize: '16px',
                            fontWeight: 'bold'
                        }
                    },
                    colors: ['#3B82F6']
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
        </script>
    @endif
@section('script')
<script src="{{ URL::to('assets/js/pages/dashboards-hr.init.js') }}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables core -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<!-- HTML5 export + Print support -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        const table = $('#alternativePagination').DataTable({
            dom: 'Bfrtip',
            responsive: false, // Disable responsive for better print control
            scrollX: true, // Enable horizontal scrolling
            buttons: [
                { 
                    extend: 'print', 
                    title: 'Recent Transfers Report', 
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] // All 12 columns
                    },
                    customize: function (win) {
                        // Add custom CSS for print
                        $(win.document.body).find('table').addClass('print-table');
                        
                        // Add landscape orientation and custom styles
                        $(win.document.head).append(`
                            <style>
                                @page { 
                                    size: landscape; 
                                    margin: 0.5cm; 
                                }
                                body { 
                                    margin: 0; 
                                    padding: 20px; 
                                    font-family: Arial, sans-serif; 
                                    font-size: 8pt; 
                                }
                                .print-table {
                                    width: 100% !important;
                                    table-layout: fixed !important;
                                    border-collapse: collapse !important;
                                }
                                .print-table th,
                                .print-table td {
                                    padding: 3px !important;
                                    border: 1px solid #ddd !important;
                                    font-size: 7pt !important;
                                    white-space: nowrap !important;
                                    overflow: hidden !important;
                                    text-overflow: ellipsis !important;
                                }
                                .print-table th {
                                    background-color: #f8f9fa !important;
                                    font-weight: bold !important;
                                }
                                h1 {
                                    text-align: center;
                                    margin-bottom: 15px;
                                    font-size: 14pt;
                                }
                                /* Hide unnecessary elements */
                                .dataTables_length,
                                .dataTables_filter,
                                .dataTables_info,
                                .dataTables_paginate,
                                .dt-buttons,
                                .print-hide {
                                    display: none !important;
                                }
                            </style>
                        `);
                        
                        // Add a title
                        $(win.document.body).prepend('<h1>Recent Transfers Report</h1>');
                    }
                },
                { 
                    extend: 'pdfHtml5', 
                    title: 'Recent Transfers Report', 
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    customize: function (doc) {
                        doc.defaultStyle.fontSize = 7;
                        doc.styles.tableHeader.fontSize = 7;
                        doc.content[1].table.widths = Array(12).fill('*');
                    }
                },
                { 
                    extend: 'excelHtml5', 
                    title: 'Recent Transfers Report', 
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                { 
                    extend: 'csvHtml5', 
                    title: 'Recent Transfers Report', 
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                }
            ],
            language: {
                paginate: {
                    previous: '<i class="fas fa-chevron-left"></i>',
                    next: '<i class="fas fa-chevron-right"></i>'
                }
            }
        });

        // Hide default DataTables buttons
        table.buttons().container().hide();

        // Bind your custom buttons to DataTables export buttons
        $('#printButton').on('click', function () {
            table.button(0).trigger(); // Print
        });

        $('#pdfButton').on('click', function () {
            table.button(1).trigger(); // PDF
        });

        $('#excelButton').on('click', function () {
            table.button(2).trigger(); // Excel
        });

        $('#csvButton').on('click', function () {
            table.button(3).trigger(); // CSV
        });
    });
</script>

<style>
    .dt-button {
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .dataTables_wrapper .dt-buttons {
        float: right;
    }
    .dataTables_length,
.dataTables_filter,
.dataTables_info,
.dataTables_paginate {
    display: none !important;
}

    /* Ensure table container is properly sized */
    #alternativePagination_wrapper {
        overflow-x: auto;
    }

    /* Print-specific styles */
    @media print {
        body {
            margin: 0 !important;
            padding: 20px !important;
            background: white !important;
            font-size: 8pt !important;
        }
        
        .card, .card-body {
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background: white !important;
        }
        
        table {
            width: 100% !important;
            font-size: 7pt !important;
            table-layout: fixed !important;
        }
        
        th, td {
            padding: 2px !important;
            border: 1px solid #ddd !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }
        
        th {
            background-color: #f8f9fa !important;
            font-weight: bold !important;
        }
        
        /* Hide unnecessary elements during print */
        .print-hide, 
        .dataTables_length, 
        .dataTables_filter, 
        .dataTables_info, 
        .dataTables_paginate, 
        .dt-buttons,
        .btn,
        .flex-wrap {
            display: none !important;
        }
        
        /* Ensure proper page breaks */
        tr {
            page-break-inside: avoid;
        }
    }

    @media (max-width: 767px) {
        .dataTables_wrapper .dt-buttons {
            float: none;
            text-align: center;
        }
    }
</style>
@endsection
@endsection