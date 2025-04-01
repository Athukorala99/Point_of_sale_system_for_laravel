@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">User Profit Report</h4>
                        <p>
                            <a href="{{route('report.index')}}" style="float: right;" class="btn btn-warning"><i class="fa fa-reply"></i>Report</a>
                        </p>
                    </div>
                    <div class="card-body">

                        <p>Start Date: {{$sdate}}</p>
                        <p>End Date: {{$edate}}</p>
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>User Name</th>
                                    <th>Bill Count</th>
                                    <th>Quantity</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($profitdetails as $profitdetail)
                                @if( \Carbon\Carbon::parse($profitdetail->created_at)->format('Y-m-d') <= $edate && \Carbon\Carbon::parse($profitdetail->created_at)->format('Y-m-d') >= $sdate )
                                <tr>
                                    <td style="text-align: center;">{{ $profitdetail->user->name ?? 'Unknown User' }}</td>
                                    <td style="text-align: center;">{{ $profitdetail->billcount }}</td>
                                    <td style="text-align: center;">{{ $profitdetail->total_quantity }}</td>
                                    <td style="text-align: right;">{{ number_format($profitdetail->total_profit, 2) }}</td>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <th colspan="3" style="text-align: right;">Total Profit</th>
                                    <td style="text-align: right; font-weight:bold;">Rs. {{ number_format($profitdetails->sum('total_profit'), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>


                        <div style="float: right;">
                            <button class="btn btn-dark" style="float: left;" onclick="PrintReceptContent('print')"><i class="fa fa-print"></i> Print Report</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal">
    <div id="print">
        @include('printReport.UserProfitReportprint')
    </div>
</div>

<style>
    .modal.right .modal-dialog {
        /* position: absolute; */
        top: 0;
        right: 0;
        margin-right: 20vh;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }

    .form-check-input {
        width: 80px;
        height: 20px;
    }

    .boxadd {
        width: 15px;
        height: 15px;
        padding-left: 500px;
    }
</style>

<script>
    function PrintReceptContent(el) {
        // Get the content from the specified element
        var content = document.getElementById(el).innerHTML;

        // Open a new window to print the receipt
        var myReceipt = window.open('', 'Profit_user_Report');
        myReceipt.screenX = 0;
        myReceipt.screenY = 0;

        // Write the content to the new window
        myReceipt.document.write(`
            <html>
                <head>
                    <title>User Profit Report</title>
                    <style>
                        /* General styles for the receipt */
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                        }
                        /* Hide all buttons in the print view */
                        @media print {
                            input[type="button"] {
                                display: none;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${content}
                </body>
            </html>
        `);

        // Focus on the new window
        myReceipt.document.close(); // Close the document to finish rendering
        myReceipt.focus();

        // Automatically open the print dialog
        myReceipt.print();

        // Automatically close the window after printing
        setTimeout(() => {
            myReceipt.close();
        }, 8000);
    }
</script>
@endsection