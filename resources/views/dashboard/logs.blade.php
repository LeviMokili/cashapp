@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                
                
            </div>
            <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                <div class="col-span-12 md:order-1 xl:col-span-8 2xl:col-span-6">
                    <h5 class="mb-2">Logs</h5>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="grid grid-cols-1 gap-4 mb-5 lg:grid-cols-2 xl:grid-cols-12">
                    <div class="xl:col-span-6">
                        <h6 class="text-15 grow">Logs</h6>
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
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Perfomed
                                by</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Confirmed
                                by</th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Status
                            </th>
                            <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">amount
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $key => $value)
                            <tr>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ ++$key }}</td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->created_at->format('D-m-Y')  }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"
                                    style="font-weight:700">
                                    {{ $value->transfer_code }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->perfomed_by }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $value->confirmed_by }}
                                </td>

                                {{ $value->telephone }}</td>
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
                                    {{ $value->amount }}
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
                    responsive: true,
                    buttons: [
                        { extend: 'print', title: 'Recent Transfers Report', exportOptions: { columns: ':visible' } },
                        { extend: 'pdfHtml5', title: 'Recent Transfers Report', exportOptions: { columns: ':visible' } },
                        { extend: 'excelHtml5', title: 'Recent Transfers Report', exportOptions: { columns: ':visible' } },
                        { extend: 'csvHtml5', title: 'Recent Transfers Report', exportOptions: { columns: ':visible' } }
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

            @media (max-width: 767px) {
                .dataTables_wrapper .dt-buttons {
                    float: none;
                    text-align: center;
                }
            }
        </style>
    @endsection
@endsection