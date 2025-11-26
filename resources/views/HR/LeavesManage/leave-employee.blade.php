@extends('layouts.master')
@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Tansfers</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Transfer Manage</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Transfer Manage(DataEntry)
                    </li>
                </ul>
            </div>
            <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-12">
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-red-500 bg-red-100 rounded-md size-12 text-15 dark:bg-red-500/20 shrink-0">
                                <i data-lucide="file-bar-chart-2"></i></div>
                            <div class="grow">
                                <h5 class="mb-1 text-16"><span class="counter-value" data-target="{{ $todayAmount }}">0</span>$</h5>
                                <p class="text-slate-500 dark:text-zink-200">Today Total Amount </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-green-500 bg-green-100 rounded-md size-12 text-15 dark:bg-green-500/20 shrink-0">
                                <i data-lucide="calendar-days"></i></div>
                            <div class="grow">
                                <h5 class="mb-1 text-16"><span class="counter-value" data-target="{{ $pendingTransfers }}">0</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">Pending Transcations</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-purple-500 bg-purple-100 rounded-md size-12 text-15 dark:bg-purple-500/20 shrink-0">
                                <i data-lucide="stethoscope"></i></div>
                            <div class="grow">
                                <h5 class="mb-1 text-16"><span class="counter-value" data-target="{{ $completedTransfers }}">0</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">Confirmed Transcations</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-purple-500 bg-purple-100 rounded-md size-12 text-15 dark:bg-purple-500/20 shrink-0">
                                <i data-lucide="stethoscope"></i></div>
                            <div class="grow">
                                <h5 class="mb-1 text-16"><span class="counter-value" data-target="{{ $cancelledTransfers }}">0</span></h5>
                                <p class="text-slate-500 dark:text-zink-200">Cancelled Transcations</p>
                            </div>
                        </div>
                    </div>
                </div>

               
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-4 mb-5 lg:grid-cols-2 xl:grid-cols-12">
                        <div class="xl:col-span-2 xl:col-start-11">
                            <div class="ltr:lg:text-right rtl:lg:text-left">
                                <a href="{{ route('hr.LeavesManage.create-leave-employee') }}" type="button"
                                    class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                    <i data-lucide="plus" class="inline-block size-4"></i>
                                    <span class="align-middle">Add Transfer</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table id="alternativePagination" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">No
                                </th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Date
                                    Date</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                    Reference Code</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                    Sender Name</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Receiver Name
                                    </th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">City From
                                </th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">City To
                                </th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                    Guichetier de provenance</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                    Guichetier de destination</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                    Telephone</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                    Status</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                    Amount</th>
                                <th
                                    class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500 ltr:text-right rtl:text-left">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($transfers as $key => $value)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ ++$key }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $value->date_transfer->format('D-m-Y')  }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500" style="font-weight:700">
                                        {{ $value->reference_code }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500" >
                                        {{ $value->sender_name }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $value->receiver_name }}</td>
                                   
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $value->ville_provenance }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $value->ville_destination }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $value->guichetier_provenance }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $value->guichetier_destination }}</td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $value->telephone }}</td>
                                    
                                    
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        @if($value->status == 'Confirmed')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">{{ $value->status }}</span>
                                        @elseif($value->status == 'Pending')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent">{{ $value->status }}</span>
                                        @elseif($value->status == 'Cancelled')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">{{ $value->status }}</span>
                                        @else
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                          {{ number_format($value->amount, 2) }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('transfers.edit', $value->id) }}" data-modal-target="leaveOverviewModal"
                                                class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 text-custom-500 bg-custom-100 hover:text-white hover:bg-custom-500 dark:bg-custom-500/20 dark:hover:bg-custom-500"><i
                                                    data-lucide="pencil" class="size-4"></i></a>
                                            <a href="{{ route('transfers.show', $value->id) }}" data-modal-target="leaveOverviewModal"
                                                class="flex items-center justify-center transition-all duration-200 ease-linear rounded-md size-8 text-custom-500 bg-custom-100 hover:text-white hover:bg-custom-500 dark:bg-custom-500/20 dark:hover:bg-custom-500"><i
                                                    data-lucide="eye" class="size-4"></i></a>
                                        </div>
                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
    @section('script')

    @endsection
@endsection