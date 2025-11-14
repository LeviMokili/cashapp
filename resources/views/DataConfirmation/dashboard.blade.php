@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">

        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Transfers</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Transfer Manage</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">Transfer Manage (DataEntry)</li>
                </ul>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 xl:grid-cols-12">
                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-red-500 bg-red-100 rounded-md size-12 text-15 dark:bg-red-500/20 shrink-0">
                                <i data-lucide="file-bar-chart-2"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value" data-target="{{ $todayAmount }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Today Total Amount</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-green-500 bg-green-100 rounded-md size-12 text-15 dark:bg-green-500/20 shrink-0">
                                <i data-lucide="calendar-days"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value" data-target="{{ $pendingTransfers }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Pending Transactions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="xl:col-span-3">
                    <div class="card">
                        <div class="flex items-center gap-3 card-body">
                            <div
                                class="flex items-center justify-center text-purple-500 bg-purple-100 rounded-md size-12 text-15 dark:bg-purple-500/20 shrink-0">
                                <i data-lucide="stethoscope"></i>
                            </div>
                            <div class="grow">
                                <h5 class="mb-1 text-16">
                                    <span class="counter-value" data-target="{{ $completedTransfers }}">0</span>
                                </h5>
                                <p class="text-slate-500 dark:text-zink-200">Confirmed Transactions</p>
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

            <!-- Transfers Table -->
            <div class="card mt-6">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Transfers</h6>

                    <table id="alternativePagination" class="display w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Reference Code</th>
                                <th>Sender Name</th>
                                <th>Receiver Name</th>
                                <th>City From</th>
                                <th>City To</th>
                                <th>Guichetier Provenance</th>
                                <th>Guichetier Destination</th>
                                <th>Telephone</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transfers as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->date_transfer)->format('d-m-Y') }}</td>
                                    <td class="font-bold">{{ $value->reference_code }}</td>
                                    <td>{{ $value->sender_name }}</td>
                                    <td>{{ $value->receiver_name }}</td>
                                    <td>{{ $value->ville_provenance }}</td>
                                    <td>{{ $value->ville_destination }}</td>
                                    <td>{{ $value->guichetier_provenance }}</td>
                                    <td>{{ $value->guichetier_destination }}</td>
                                    <td>{{ $value->telephone }}</td>
                                    <td>
                                        @if($value->status == 'Confirmed')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 text-green-500">
                                                {{ $value->status }}
                                            </span>
                                        @elseif($value->status == 'Pending')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-yellow-100 text-yellow-500">
                                                {{ $value->status }}
                                            </span>
                                        @elseif($value->status == 'Declined')
                                            <span
                                                class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-red-100 text-red-500">
                                                {{ $value->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $value->amount }}</td>
                                    <td>
                                        <div class="flex justify-center gap-2">
                                            <button type="button"
                                                onclick="openStatusModal({{ $value->id }}, '{{ $value->status }}')"
                                                class="flex items-center justify-center rounded-md size-8 text-blue-500 bg-blue-100 hover:text-white hover:bg-blue-500 dark:bg-blue-500/20 dark:hover:bg-blue-500">
                                                <i data-lucide="refresh-ccw" class="size-4"></i>
                                            </button>
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

    <!-- Status Update Modal -->
    <div id="statusModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg w-96 p-6 relative">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Update Transfer Status</h2>

            <input type="hidden" id="transfer_id">

            <label for="new_status" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">
                Select new status:
            </label>
            <select id="new_status" class="w-full border rounded-md p-2 mb-4 dark:bg-zinc-700 dark:text-white">
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeStatusModal()"
                    class="px-4 py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-zinc-600 dark:text-white">
                    Cancel
                </button>
                <button type="button" onclick="updateStatus()"
                    class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700">
                    Update
                </button>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        function openStatusModal(id, currentStatus) {
            document.getElementById('transfer_id').value = id;
            document.getElementById('new_status').value = currentStatus;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        function updateStatus() {
            const id = document.getElementById('transfer_id').value;
            const newStatus = document.getElementById('new_status').value;

            // Show loading state
            const updateBtn = document.querySelector('button[onclick="updateStatus()"]');
            const originalText = updateBtn.textContent;
            updateBtn.textContent = 'Updating...';
            updateBtn.disabled = true;

            fetch(`/user2/transfers/${id}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ status: newStatus }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        closeStatusModal();

                        // Update the status badge in the table
                        const row = document.querySelector(`button[onclick*="openStatusModal(${id},"]`).closest('tr');
                        const statusCell = row.querySelector('td:nth-child(11)');

                        let badgeHTML = '';
                        if (newStatus === 'Confirmed') {
                            badgeHTML = `<span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 text-green-500">${newStatus}</span>`;
                        } else if (newStatus === 'Pending') {
                            badgeHTML = `<span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-yellow-100 text-yellow-500">${newStatus}</span>`;
                        } else if (newStatus === 'Cancelled') {
                            badgeHTML = `<span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-red-100 text-red-500">${newStatus}</span>`;
                        }

                        statusCell.innerHTML = badgeHTML;

                        // Show success message
                        showAlert('Status updated successfully!', 'success');
                    } else {
                        showAlert(data.message || 'Failed to update status.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Error updating status: ' + error.message, 'error');
                })
                .finally(() => {
                    // Reset button state
                    updateBtn.textContent = originalText;
                    updateBtn.disabled = false;
                });
        }

        // Helper function to show alerts
        function showAlert(message, type = 'info') {
            // You can use your preferred alert method here
            // This is a simple implementation using browser alert
            if (type === 'error') {
                alert('Error: ' + message);
            } else {
                alert(message);
            }

            // For better UX, consider using a toast notification library
            // or implement your own toast system
        }
    </script>
@endsection