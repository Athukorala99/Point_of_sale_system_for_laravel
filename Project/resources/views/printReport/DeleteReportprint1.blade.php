<div id="invoice-POS">
    <!-- {{--Print section--}} -->

    <div class="printed_content" style="text-align: center;">
        <center>
            <div class="logo">
                <b>
                    Delete Order Report
                </b>
            </div>
            <hr>
        </center>
    </div>

        <table style="width: 100%; ">
        <td style="text-align: left;font-size:12px" >Start Date: <span class="space">{{$sdate}}</span></td>
        <td style="text-align: center;font-size:12px">End Date: <span class="space">{{$edate}}</span></td>
        <td style="text-align: right;font-size:12px">Today Date: <span id="date-time"></span></td>
        </table>
        
    <hr>

    <div class="detail">
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: center;">
                    <th>User</th>
                    <th>Date / Time</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Bill Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($delorders as $delorder)
                @if($delorder->created_at < $edate && $delorder->created_at > $sdate)
                    <tr>
                        <td style="text-align: left;">{{$delorder->userdata->name}}</td>
                        <td style="text-align: left;">{{$delorder->created_at}}</td>
                        <td style="text-align: left;">
                            @foreach($delorder->deleteorderdetail as $pro)
                            {{$pro->product->product_name}}<br>
                            @endforeach
                        </td>
                        <td style="text-align: center;">
                            @foreach($delorder->deleteorderdetail as $pro)
                            {{$pro->quantity}}<br>
                            @endforeach
                        </td>
                        <td style="text-align: right;">
                            @foreach($delorder->deleteorderdetail as $pro)
                            {{$pro->price * $pro->quantity}}<br>
                            @endforeach
                        </td>
                        <td style="text-align: right;">{{number_format($delorder->total, 2)}}</td>
                    </tr>
                    @endif
                    @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* A4 Page Layout */
    @page {
        size: A4;
        margin: 20mm;
    }

    #invoice-POS {
        width: 100%;
        max-width: 210mm;
        margin: auto;
        font-family: Arial, sans-serif;
        color: #333;
        font-size: 12px;
        background: #fff;
        padding: 10mm;
    }

    #invoice-POS h1,
    #invoice-POS h2,
    #invoice-POS h3 {
        margin: 0;
        text-align: center;
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
    const FormattedDateTime = CurrentDate.toLocaleDateString() + ' ' + CurrentDate.toLocaleTimeString();
    DateTimeElement.textContent = FormattedDateTime;
</script>