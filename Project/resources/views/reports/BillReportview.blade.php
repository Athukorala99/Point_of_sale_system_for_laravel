@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Sales Report</h4>
                        <p>
                            <a href="{{route('report.index')}}" style="float: right;" class="btn btn-warning"><i class="fa fa-reply"></i>Report</a>
                        </p>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>Bill No. </th>
                                    <th>User</th>
                                    <th>Billing Date</th>
                                    <th>Amount (Rs.)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $order)
                            @if( \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') <= $edate && \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') >= $sdate )

                                <tr>
                                    <td style="text-align: center;">{{$order->order_id}}</td>
                                    <td style="text-align: center;">{{$order->userdata->name}}</td>
                                    <td style="text-align: center;">{{$order->transac_date}}</td>
                                    <td style="text-align: right;">{{$order->transac_amount}}</td>
                                </tr>
                                    @endif
                                @endforeach
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
        @include('printReport.BillReportPrint')
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

    .table thead th {
        text-align: center;
        vertical-align: middle;
    }
</style>
<script>
    function PrintReceptContent(el) {
        // Get the content from the specified element
        var content = document.getElementById(el).innerHTML;

        // Open a new window to print the receipt
        var myReceipt = window.open('', 'Sales_Report');
        myReceipt.screenX = 0;
        myReceipt.screenY = 0;

        // Write the content to the new window
        myReceipt.document.write(`
            <html>
                <head>
                    <title>Sales Report</title>
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