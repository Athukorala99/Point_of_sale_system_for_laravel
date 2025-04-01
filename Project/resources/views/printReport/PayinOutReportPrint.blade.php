<div id="invoice-POS">
    <!-- {{--Print section--}} -->

    <div class="printed_content" style="text-align: center; ">
        <center>
            <div class="logo">
                <b style="font-size: 15px;">
                    Pay in Out Report
                </b>
            </div>
            <hr>
        </center>
    </div>
    <div>
        <table>
            <tr>
                <td style="border: none;">Start Date : <span class="space">{{$sdate}}</span></td>
                <td style="border: none; text-align:right;"> End Date : <span class="space">{{$edate }}</span></td>
            </tr>

            <!-- <td style="text-align: right;font-size:12px">Today Date: <span id="date-time"></span></td> -->
        </table>
    </div>

    <hr>

    <div class="detail">
        <center>
            <table border="1" style="width: 99%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: center;">
                        <th>User/ <br>Enter by</th>
                        <th>Payin</th>
                        <th>Payout</th>
                        <th>Cash</th>
                        <th>Card</th>
                        <th>Bank</th>
                        <th>Consumer <br> Credit</th>
                        <th>Total <br> Sale</th>
                        <th>Hand <br> Money</th>
                        <th>Bill <br> Count</th>
                        <!-- <th>Review</th> -->


                    </tr>
                </thead>
                <tbody>
                    @foreach($payinouts as $payinout)
                    @if( \Carbon\Carbon::parse($payinout->created_at)->format('Y-m-d') <= $edate && \Carbon\Carbon::parse($payinout->created_at)->format('Y-m-d') >= $sdate )

                        <tr>
                            <td style="text-align:left; padding-left:5px;"> {{$payinout->userdata->name}}&nbsp;/<br>{{$payinout->userdataa->name}} </td>
                            <td style="text-align: right;"> {{number_format($payinout->payincash,2)}} </td>
                            <td style="text-align: right;"> {{number_format($payinout->payoutcash,2)}}</td>
                            <td style="text-align: right;"> {{number_format($payinout->cash,2)}} </td>
                            <td style="text-align: right;"> {{number_format($payinout->card,2)}} </td>
                            <td style="text-align: right;"> {{number_format($payinout->bank,2)}} </td>
                            <td style="text-align: right;"> {{number_format($payinout->consumer_credit,2)}} </td>
                            <td style="text-align: right;"> {{number_format($payinout->cash + $payinout->card + $payinout->bank + $payinout->consumer_credit + $payinout->payoutcash -  $payinout->payincash,2) }} </td>
                            <td style="text-align: right;"> {{number_format($payinout->hand_money,2)}} </td>
                            <td style="text-align: center;"> {{($payinout->bill_count)}} </td>
                            
                        </tr>
                        @endif
                        @endforeach                                        
                </tbody>
            </table>
        </center>
    </div>
    <hr>
    <br>
    <div class="tdaydt">
        <td style="text-align: right;font-size:12px">Today Date: <span id="date-time"></span></td>
    </div>
</div>



<style>
    /* A4 Page Layout */
    @media print {
        @page {
            size: A4;

        }

        .printPageButton {
            display: none;
        }
    }

    #invoice-POS {
        width: 100%;
        max-width: 210mm;
        margin: auto;
        font-family: Arial, sans-serif;
        color: #333;
        font-size: 12px;
        background: #fff;
        /* padding: 10mm; */
    }

    #invoice-POS p {
        margin: 5px 0;
        font-size: 12px;
    }

    /* Table Styling */
    #invoice-POS table {
        width: 100%;
        border-collapse: collapse;
    }

    #invoice-POS table th,
    #invoice-POS table td {
        font-size: 12px;
        border: 1px solid #ddd;
        /* padding: 8px; */
    }

    #invoice-POS table th {
        background: #f4f4f4;
        text-align: center;
    }

    #invoice-POS table td {
        text-align: left;
    }

    /* Header Section */
    .logo {
        font-size: 14px;
        font-weight: bold;
        text-align: center;
    }

    /* Detail Section */
    .detail {
        margin: 10px 0;
    }

    .detail p {
        margin: 2px 0;
    }

    /* Print Optimization */
    @media print {
        body {
            margin: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        #invoice-POS {
            box-shadow: none;
            margin: 0;
            page-break-after: avoid;
        }
    }
</style>
</style>

<script>
    const DateTimeElement = document.getElementById('date-time');
    const CurrentDate = new Date();
    const FormattedDateTime = CurrentDate.toLocaleDateString() + ' ' + CurrentDate.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });
    DateTimeElement.textContent = FormattedDateTime;
</script>