@extends('layouts.master')
@section('content')
    <!-- Page-content -->

    <style>
        .payment-success {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 480px;
            padding: 40px 30px;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background-color: #e8f5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .success-icon i {
            font-size: 36px;
            color: #4caf50;
        }

        .success-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
        }

        .payment-details {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e8e8e8;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 15px;
            color: #666;
            font-weight: 500;
        }

        .detail-value {
            font-size: 15px;
            color: #1a1a1a;
            font-weight: 600;
        }

        .amount-value {
            font-size: 18px;
            color: #1a73e8;
            font-weight: 700;
        }

        .signature-field {
            display: none;
        }

        .action-button {
            width: 100%;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .action-button:hover {
            background-color: #0d62d9;
            transform: translateY(-2px);
        }

        .action-button:active {
            transform: translateY(0);
        }

        .action-button.printing {
            background-color: #666;
            cursor: not-allowed;
        }

        .action-button i {
            font-size: 18px;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f44336;
            border-radius: 50%;
            opacity: 0.7;
            animation: fall 5s linear infinite;
            z-index: -1;
        }

        @keyframes fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Print Styles */
        @media print {
            body {
                background-color: white;
                padding: 0;
                display: block;
            }

            .payment-success {
                box-shadow: none;
                border-radius: 0;
                max-width: 100%;
                padding: 20px;
                margin: 0;
            }

            .action-button,
            .confetti {
                display: none !important;
            }

            .success-icon {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .payment-details {
                background-color: #f8f8f8 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .signature-field {
                display: flex !important;
                margin-top: 20px;
                padding-top: 20px;
                border-top: 1px dashed #ccc;
                justify-content: space-between;
                align-items: center;
            }

            .signature-line {
                flex: 1;
                height: 1px;
                background-color: #333;
                margin: 0 15px;
            }

            .signature-label {
                font-size: 14px;
                color: #666;
                white-space: nowrap;
            }
        }

        /* Print-specific receipt styling */
        .receipt-header {
            display: none;
        }

        @media print {
            .receipt-header {
                display: block;
                text-align: center;
                margin-bottom: 30px;
                border-bottom: 2px solid #1a73e8;
                padding-bottom: 15px;
            }

            .receipt-header h2 {
                font-size: 24px;
                color: #1a73e8;
                margin-bottom: 10px;
            }

            .receipt-header p {
                font-size: 14px;
                color: #666;
            }

            .success-title {
                color: #4caf50;
            }

            .detail-label {
                font-weight: 600;
            }
        }

        /* Print instructions */
        .print-instructions {
            margin-top: 15px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">💸Receipt</h5>
                </div>

            </div>
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
                <div class="xl:col-span-9">

                    <div class="payment-success">


                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>

                        <h1 class="success-title">Payment Success!</h1>

                        <div class="payment-details">
                            <div class="detail-row">
                                <div class="detail-label">Reference Number</div>
                                <div class="detail-value" style="font-weight:900">{{ $transfer->reference_code }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Date</div>
                                <div class="detail-value">{{ $transfer->created_at->format('M j, Y') }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Time</div>
                                <div class="detail-value">{{ $transfer->created_at->format('H:i') }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Sender name</div>
                                <div class="detail-value">{{ $transfer->sender_name }}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Receiver name</div>
                                <div class="detail-value">{{ $transfer->receiver_name }}</div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">Amount</div>
                                <div class="detail-value amount-value">${{ number_format($transfer->amount, 2)}}</div>
                            </div>

                            <!-- Signature field - only visible when printing -->
                            <div class="signature-field" style="heght: 80px;">
                                <div class="signature-label">Authorized Signature</div>
                                <!-- <div class="signature-line"></div> -->

                            </div>
                        </div>

                        <button class="action-button" id="printButton">
                            <i class="fas fa-file-pdf"></i>
                            Print Receipt
                        </button>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Create confetti effect
        function createConfetti() {


            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDuration = (Math.random() * 3 + 3) + 's';
                confetti.style.animationDelay = Math.random() * 5 + 's';
                document.body.appendChild(confetti);
            }
        }

        // Create confetti on page load
        window.addEventListener('load', createConfetti);

        // Enhanced print functionality
        document.getElementById('printButton').addEventListener('click', function () {
            const button = this;
            const originalText = button.innerHTML;

            // Add loading state
            button.classList.add('printing');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Preparing PDF...';
            button.disabled = true;

            // Add a small delay to show the loading state
            setTimeout(() => {
                window.print();

                // Restore button after print dialog closes
                setTimeout(() => {
                    button.classList.remove('printing');
                    button.innerHTML = originalText;
                    button.disabled = false;
                }, 1000);
            }, 500);
        });

        // Optional: Add a message before printing
        window.addEventListener('beforeprint', function () {
            console.log('Preparing receipt for printing...');
        });

        // Optional: Add a message after printing
        window.addEventListener('afterprint', function () {
            console.log('Printing completed or canceled');
        });
    </script>

@endsection