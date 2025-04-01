<div id="invoice-POS">
    <!-- {{--Print section--}} -->

    <div class="printed_content" style="text-align: center; ">
        <center>
            <div class="logo">
                <b style="font-size: 15px;">
                    Sales Report
                </b>
            </div>
            <hr>
        </center>
    </div>



    <div class="detail">
        <center>
            <table border="1" style="width: 99%; border-collapse: collapse;">
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
                        <td style="text-align: center;">{{$order->user_id}}</td>
                        <td style="text-align: center;">{{$order->transac_date}}</td>
                        <td style="text-align: right;">{{$order->transac_amount}}</td>
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
        padding: 8px;
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

    .namedate {
        font-size: 12px;
        margin-bottom: 10px;
    }

    .namedate .datee,
    .namedate .namee {
        display: inline-block;
        width: 49%;
    }


    .table thead th {
        text-align: center;
        /*  */
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