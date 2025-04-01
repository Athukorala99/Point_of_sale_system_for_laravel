@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Pay In Out Report</h4>
                        <p>
                            <a href="{{route('report.index')}}" style="float: right;" class="btn btn-warning"><i class="fa fa-reply"></i>Report</a>
                        </p>
                    </div>
                    <div class="card-body">

                        <p>Start Date : {{$sdate}} </p>
                        <p> End Date : {{$edate}} </p>
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>User/ <br>Enter by </th>
                                    <th>Payin</th>
                                    <th>Payout</th>
                                    <th>Cash</th>
                                    <th>card</th>
                                    <th>Bank</th>
                                    <th>Consumer <br> Credit</th>
                                    <th>Total <br>Sale</th>
                                    <th>Hand <br>Money</th>
                                    <th>Bill <br>Count</th>
                                    <th>Review</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payinouts as $payinout)
                                @if( \Carbon\Carbon::parse($payinout->created_at)->format('Y-m-d') <= $edate && \Carbon\Carbon::parse($payinout->created_at)->format('Y-m-d') >= $sdate )

                                
                                
                                    <tr>
                                        <td style="text-align: left;">{{$payinout->userdata->name}} / <br>{{$payinout->userdataa->name}} </td>
                                        <td style="text-align: right;">{{number_format($payinout->payincash,2)}}</td>
                                        <td style="text-align: right;">{{number_format($payinout->payoutcash,2)}}</td>
                                        <td style="text-align: right;">{{number_format($payinout->cash,2)}}</td>
                                        <td style="text-align: right;">{{number_format($payinout->card,2)}}</td>
                                        <td style="text-align: right;">{{number_format($payinout->bank,2)}}</td>
                                        <td style="text-align: right;">{{number_format($payinout->consumer_credit,2)}}</td>
                                        <td style="text-align: right;">{{number_format($payinout->cash + $payinout->card + $payinout->bank + $payinout->consumer_credit + $payinout->payoutcash -  $payinout->payincash,2) }}</td>
                                        <td style="text-align: right;">{{number_format($payinout->hand_money,2)}}</td>
                                        <td style="text-align: center;">{{($payinout->bill_count)}}</td>
                                        <td style="text-align: left;">
                                            <!-- 5star -->
                                            @if((($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == 0 )
                                            <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                            @endif

                                            <!-- 4 star -->
                                            @if((($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == 1 || (($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == -1 )
                                            <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                            @endif

                                            <!-- 3 star -->
                                            @if((($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == 2 || (($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == -2 )
                                            <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                            @endif

                                            <!-- 2 star -->
                                            @if((($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == 3 || (($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == -3 )
                                            <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
                                            @endif

                                            <!-- 1 star -->
                                            @if((($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == 4 || (($payinout->cash - $payinout->hand_money) / $payinout->bill_count) == -4 )
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            @endif

                                            <!-- 0 star -->
                                            @if((($payinout->cash - $payinout->hand_money) / $payinout->bill_count) >= 5 || (($payinout->cash - $payinout->hand_money) / $payinout->bill_count) <= -5 )
                                                --- @endif
                                                </td>
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
        @include('printReport.PayinoutReportPrint')
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
        var myReceipt = window.open('', 'Payinout_Report');
        myReceipt.screenX = 0;
        myReceipt.screenY = 0;

        // Write the content to the new window
        myReceipt.document.write(`
            <html>
                <head>
                    <title>Payin Out Report</title>
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