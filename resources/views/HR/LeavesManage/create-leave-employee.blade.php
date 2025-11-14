@extends('layouts.master')
@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">💸 New Cash Transfer Entry</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Transfers</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">Add Cash Transfer</li>
                </ul>
            </div>
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
                <div class="xl:col-span-9">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-4 text-15 grow"></h6>
                            <form id="transferForm" action="{{ route('hr.LeavesManage.create-leave-employee') }}" method="POST">
                                @csrf

                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-12">
                                    <!-- Date Field -->
                                    <div class="xl:col-span-6">
                                        <div>
                                            <label for="date_transfer" class="inline-block mb-2 text-base font-medium">Date</label>
                                            <input type="text" name="date_transfer" id="date_transfer"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('date_transfer') is-invalid @enderror"
                                                placeholder="Select date" data-provider="flatpickr" data-date-format="Y-m-d"
                                                value="{{ old('date_transfer') }}"
                                                onchange="generateReferenceCode()">
                                            @error('date_transfer')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <!-- Reference Code Field -->
                                    <div class="xl:col-span-6">
                                        <div>
                                            <label for="reference_code" class="inline-block mb-2 text-base font-medium">Reference Code</label>
                                            <input type="text" name="reference_code" id="reference_code"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                value="{{ old('reference_code') }}" readonly>
                                        </div>
                                    </div>

                                    <!-- Sender Name -->
                                    <div class="xl:col-span-6">
                                        <label for="sender_name" class="inline-block mb-2 text-base font-medium">Sender Name</label>
                                        <input type="text" name="sender_name" id="sender_name"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('sender_name') is-invalid @enderror"
                                            value="{{ old('sender_name') }}">
                                        @error('sender_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Receiver Name -->
                                    <div class="xl:col-span-6">
                                        <label for="receiver_name" class="inline-block mb-2 text-base font-medium">Receiver Name</label>
                                        <input type="text" name="receiver_name" id="receiver_name"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('receiver_name') is-invalid @enderror"
                                            value="{{ old('receiver_name') }}">
                                        @error('receiver_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- City From -->
                                    <div class="xl:col-span-6">
                                        <label for="ville_provenance" class="inline-block mb-2 text-base font-medium">City From</label>
                                        <select name="ville_provenance" id="ville_provenance"
                                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500"
                                            data-choices="" data-choices-search-false="">
                                            <option value="Butembo 1" {{ old('ville_provenance') == 'Butembo 1' ? 'selected' : '' }}>Butembo 1</option>
                                            <option value="Butembo 2" {{ old('ville_provenance') == 'Butembo 2' ? 'selected' : '' }}>Butembo 2</option>
                                            <option value="Beni" {{ old('ville_provenance') == 'Beni' ? 'selected' : '' }}>Beni</option>
                                            <option value="Bunia" {{ old('ville_provenance') == 'Bunia' ? 'selected' : '' }}>Bunia</option>
                                            <option value="Durba" {{ old('ville_provenance') == 'Durba' ? 'selected' : '' }}>Durba</option>
                                            <option value="Arua" {{ old('ville_provenance') == 'Arua' ? 'selected' : '' }}>Arua</option>
                                            <option value="Kisangani" {{ old('ville_provenance') == 'Kisangani' ? 'selected' : '' }}>Kisangani</option>
                                            <option value="Kinshasa" {{ old('ville_provenance') == 'Kinshasa' ? 'selected' : '' }}>Kinshasa</option>
                                            <option value="Goma" {{ old('ville_provenance') == 'Goma' ? 'selected' : '' }}>Goma</option>
                                            <option value="Bukavu" {{ old('ville_provenance') == 'Bukavu' ? 'selected' : '' }}>Bukavu</option>
                                            <option value="Isiro" {{ old('ville_provenance') == 'Isiro' ? 'selected' : '' }}>Isiro</option>
                                            <option value="Kampala" {{ old('ville_provenance') == 'Kampala' ? 'selected' : '' }}>Kampala</option>
                                            <option value="Daresalam" {{ old('ville_provenance') == 'Daresalam' ? 'selected' : '' }}>Daresalam</option>
                                            <option value="Nairobi" {{ old('ville_provenance') == 'Nairobi' ? 'selected' : '' }}>Nairobi</option>
                                            <option value="China" {{ old('ville_provenance') == 'China' ? 'selected' : '' }}>China</option>
                                            <option value="Dubai" {{ old('ville_provenance') == 'Dubai' ? 'selected' : '' }}>Dubai</option>
                                            <option value="India" {{ old('ville_provenance') == 'India' ? 'selected' : '' }}>India</option>
                                            <option value="Moku" {{ old('ville_provenance') == 'Moku' ? 'selected' : '' }}>Moku</option>
                                            <option value="Wanga" {{ old('ville_provenance') == 'Wanga' ? 'selected' : '' }}>Wanga</option>
                                        </select>
                                        @error('ville_provenance')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- City To -->
                                    <div class="xl:col-span-6">
                                        <label for="ville_destination" class="inline-block mb-2 text-base font-medium">City To</label>
                                        <select name="ville_destination" id="ville_destination"
                                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500"
                                            data-choices="" data-choices-search-false="">
                                            <option value="Butembo 1" {{ old('ville_destination') == 'Butembo 1' ? 'selected' : '' }}>Butembo 1</option>
                                            <option value="Butembo 2" {{ old('ville_destination') == 'Butembo 2' ? 'selected' : '' }}>Butembo 2</option>
                                            <option value="Beni" {{ old('ville_destination') == 'Beni' ? 'selected' : '' }}>Beni</option>
                                            <option value="Bunia" {{ old('ville_destination') == 'Bunia' ? 'selected' : '' }}>Bunia</option>
                                            <option value="Durba" {{ old('ville_destination') == 'Durba' ? 'selected' : '' }}>Durba</option>
                                            <option value="Arua" {{ old('ville_destination') == 'Arua' ? 'selected' : '' }}>Arua</option>
                                            <option value="Kisangani" {{ old('ville_destination') == 'Kisangani' ? 'selected' : '' }}>Kisangani</option>
                                            <option value="Kinshasa" {{ old('ville_destination') == 'Kinshasa' ? 'selected' : '' }}>Kinshasa</option>
                                            <option value="Goma" {{ old('ville_destination') == 'Goma' ? 'selected' : '' }}>Goma</option>
                                            <option value="Bukavu" {{ old('ville_destination') == 'Bukavu' ? 'selected' : '' }}>Bukavu</option>
                                            <option value="Isiro" {{ old('ville_destination') == 'Isiro' ? 'selected' : '' }}>Isiro</option>
                                            <option value="Kampala" {{ old('ville_destination') == 'Kampala' ? 'selected' : '' }}>Kampala</option>
                                            <option value="Daresalam" {{ old('ville_destination') == 'Daresalam' ? 'selected' : '' }}>Daresalam</option>
                                            <option value="Nairobi" {{ old('ville_destination') == 'Nairobi' ? 'selected' : '' }}>Nairobi</option>
                                            <option value="China" {{ old('ville_destination') == 'China' ? 'selected' : '' }}>China</option>
                                            <option value="Dubai" {{ old('ville_destination') == 'Dubai' ? 'selected' : '' }}>Dubai</option>
                                            <option value="India" {{ old('ville_destination') == 'India' ? 'selected' : '' }}>India</option>
                                            <option value="Moku" {{ old('ville_destination') == 'Moku' ? 'selected' : '' }}>Moku</option>
                                            <option value="Wanga" {{ old('ville_destination') == 'Wanga' ? 'selected' : '' }}>Wanga</option>
                                        </select>
                                        @error('ville_destination')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Guichetier Provenance -->
                                    <div class="xl:col-span-6">
                                        <label for="guichetier_provenance" class="inline-block mb-2 text-base font-medium">Guichetier de provenance</label>
                                        <input type="text" name="guichetier_provenance" id="guichetier_provenance"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('guichetier_provenance') is-invalid @enderror"
                                            value="{{ old('guichetier_provenance') }}">
                                        @error('guichetier_provenance')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Guichetier Destination -->
                                    <div class="xl:col-span-6">
                                        <label for="guichetier_destination" class="inline-block mb-2 text-base font-medium">Guichetier de destination</label>
                                        <input type="text" name="guichetier_destination" id="guichetier_destination"
                                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200 @error('guichetier_destination') is-invalid @enderror"
                                            value="{{ old('guichetier_destination') }}">
                                        @error('guichetier_destination')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Telephone -->
                                    <div class="xl:col-span-6">
                                        <div>
                                            <label for="telephone" class="inline-block mb-2 text-base font-medium">Telephone</label>
                                            <input type="tel" name="telephone" id="telephone"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                value="{{ old('telephone') }}">
                                            @error('telephone')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Amount -->
                                    <div class="xl:col-span-6">
                                        <div>
                                            <label for="amount" class="inline-block mb-2 text-base font-medium">Amount</label>
                                            <input type="number" name="amount" id="amount" step="0.01"
                                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                value="{{ old('amount') }}">
                                            @error('amount')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end gap-2 mt-4">
                                    <button type="reset" id="reset_btn"
                                        class="text-red-500 bg-white btn hover:text-red-500 hover:bg-red-100 focus:text-red-500 focus:bg-red-100 active:text-red-500 active:bg-red-100 dark:bg-zink-700 dark:hover:bg-red-500/10 dark:focus:bg-red-500/10 dark:active:bg-red-500/10">Reset</button>
                                    <button type="submit" id="submit_btn"
                                        class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Add Transfer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // Generate reference code when page loads and when date changes
    document.addEventListener('DOMContentLoaded', function() {
        // Generate reference code if date already has value (after form submission with errors)
        if (document.getElementById('date_transfer').value) {
            generateReferenceCode();
        }
    });

    function generateReferenceCode() {
        const dateInput = document.getElementById('date_transfer');
        const referenceInput = document.getElementById('reference_code');

        if (!dateInput.value) {
            referenceInput.value = '';
            return;
        }

        // Show loading state
        referenceInput.value = 'Generating...';

        fetch('{{ route("transfers.get-reference") }}?date=' + dateInput.value, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            referenceInput.value = data.reference_code;
        })
        .catch(error => {
            console.error('Error generating reference code:', error);
            referenceInput.value = 'Error generating code';
        });
    }

    // Reset form handler
    document.getElementById('reset_btn').addEventListener('click', function() {
        document.getElementById('reference_code').value = '';
    });
</script>
@endsection