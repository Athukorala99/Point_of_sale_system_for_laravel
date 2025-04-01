<div id="invoice-POS">
    <!-- {{--Print section--}} -->

    <div class="printed_content" style="text-align: center;">
        <center>
            <div class="logo">
                RECEIPT                
            </div>            
            <!-- <div class="info">

            </div> -->
            
            <p style="color: black; font-size:12px; "> <b>{{$companies[0]->company_name}}</b></p>
            <p style="font-size:9px;">{{$companies[0]->company_address}} <br>
            {{$companies[0]->company_email}} | {{$companies[0]->company_phone}}
            
            </p>
        </center>
    </div>
    <div class="dashed-line"></div>

    <div class="detail">
        <p style="font-size: 9px;">
            බිල් අංකය &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; : <span class="space"></span> {{$lastID}} <br>
            භාණ්ඩ සංඛ්‍යාව &nbsp; : <span class="space"></span> {{number_format($order_recept->count('amount'))}} <br>
            අයකැමි &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <span class="space"></span> {{auth()->user()->name}} <br>
            <!-- දිනය/වේලාව &nbsp; &nbsp; : <span class="space"></span> {{$transactionsdate}} -->
            දිනය/වේලාව &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; : <span class="space"></span><span id="date-time"></span>

            
        </p>
    </div>
    
    <div class="dashed-line"></div>
    

    <!-- End recipt -->
    <div class="bot">
        <div id="table">
            <table style="width: 100%;">
                <tr class="tabletitle" style="font-size: 20px; text-align: center;">
                    <td class="Hours">
                        <h2>ප්‍රමාණය</h2>
                    </td>
                    <td class="Rate">
                        <h2>සඳහන් මිල</h2>
                    </td>
                    <td class="Rate">
                        <h2>අපේ මිල</h2>
                    </td>
                    <td class="Rate">
                        <h2>එකතුව</h2>
                    </td>
                </tr>

                @foreach($order_recept as $recept)
                <tr class="">
                    <td class="tableitem" colspan="4">
                        <p class="itemtext">{{$recept->product->print_name}} - {{$recept->product->barcode}}</p>
                    </td>
                </tr>
                <tr class="service">
                    <td class="tableitemo">
                        <p class="itemtext">{{ $recept->quantity}}</p>
                    </td>
                    <td class="tableitemo">
                        <p class="itemtext">{{$price =number_format($recept->product->price,2)}}</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext" style="text-align:center;">{{$pricenow = number_format($recept->unitprice,2)}}</p>
                    </td>
                    <td class="tableitemr">
                        <p class="itemtext">{{number_format($recept->amount,2)}}</p>
                    </td>

                </tr>
                @endforeach
                <!-- <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td class="Rate">
                        <p class="itemtext">Tax</p>
                    </td>
                    <td class="Payment">
                        <p class="itemtext">Rs. 0</p>
                    </td>
                </tr> -->
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">මුළු එකතුව</td>
                    <td class="Rate" colspan="3" style="text-align: right;">
                        Rs. {{number_format($order_recept->sum('amount'),2)}}
                    </td>
                </tr>
                <tr class="" style="font-size: 12px;">
                    <td></td>
                    <td class="Rate">දුන් මුදල</td>
                    <td class="Rate" colspan="3" style="text-align: right;">
                        Rs. {{number_format($paidcash,2)}}
                    </td>
                </tr>
                <tr class="" style="font-size: 12px;">
                    <td></td>
                    <td class="Rate">ඉතිරි මුදල</td>
                    <td class="Rate" colspan="2" style="text-align: right;">
                        Rs. {{number_format($paidcash - ($order_recept->sum('amount')) ,2)}}
                    </td>
                </tr>
               @if(($order_recept->sum('orginal_price') - $order_recept->sum('amount')>0))
                <tr class="" style="font-size: 12px;">
                    <td></td>
                    <td class="Rate">ඔබේ ලාභය</td>
                    <td class="Rate" colspan="2" style="text-align: right;">
                        Rs.  {{number_format($order_recept->sum('orginal_price') - $order_recept->sum('amount'),2)}}
                    </td>
                </tr>
                @endif
            </table>
            <div class="dashed-line"></div>
            <center>
                <div class="legalcopy">
                    <p class="legal"><strong>** Thank you for visiting ** </strong> <br> The good which are subject to tax, prices includes tax</p>
                </div>
            </center>
            
        </div>
    </div>
</div>


<style>
    #invoice-POS {
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 80mm;
        background: #fff;
    }

    #invoice-POS ::selection {
        background: #34495E;
        color: #fff
    }

    #invoice-POS ::moz-selection {
        background: #34495E;
        color: #fff
    }

    #invoice-POS h1 {
        font-size: 1.5em;
        color: #222;
    }

    #invoice-POS h2 {
        font-size: 0.5em;
    }

    #invoice-POS h3 {
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }

    #invoice-POS p {
        font-size: 0.7em;
        line-height: 1.2em;
        color: #666;
    }

    #invoice-POS #top,
    #invoice-POS #mid,
    #invoice-POS #bot {
        border-bottom: 1px solid #eee;
    }

    #invoice-POS #top {
        min-height: 100px;
    }

    #invoice-POS #mid {
        min-height: 80px;

    }

    #invoice-POS #bot {
        min-height: 50px;
    }

    .logo {
        height: 20px;
        width: 60px;
        font-size: small;
        font-weight: bold;
        background-image: url() no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
    }

    .info {
        display: block;
        margin-left: 0;
        text-align: center;
    }

    #invoice-POS .title {
        float: right;
    }

    #invoice-POS.title p {
        text-align: right;
    }

    #invoice-POS table {
        width: 100%;
        border-collapse: collapse;
    }

    #invoice-POS .tabletitle {
        font-size: 0.9em;
        background: #eee;
        width: 100%;
    }

    #invoice-POS .service {
        border-bottom: 1px solid #eee;
    }

    /* .Rate{
        width: 50mm;
    }
    .Hours{
        width: 50mm;
    } */
    #invoice-POS .item {
        width: 24mm;
    }

    #invoice-POS .itemtext {
        font-size: 9px;
    }

    #invoice-POS #legalcopy {
        margin-top: 5mm;
        text-align: center;
    }

    #invoice-POS .serial-number {
        margin-top: 5mm;
        text-align: center;
        margin-bottom: 2mm;
        font-size: 12px;
    }

    #invoice-POS .serial {
        font-size: 10px !important;
    }

    .tableitemr {
        text-align: right;
    }

    .tableitemo {
        text-align: center;
    }

    .payment {
        text-align: right;
    }



    .dashed-line {
        border-top: 1px dashed black;
        width: 100%;
        margin: 10px 0;
    }
    .detail{
        margin-left: 10px;
    }
    .detail .space{
        display: inline-block;
        width: 20px;
    }
</style>

<script>

    const DateTimeElement = document.getElementById('date-time');

    const CurrentDate = new Date();
    const FormatedDateTime = CurrentDate.toLocaleDateString() + ' ' + CurrentDate.toLocaleTimeString();

    DateTimeElement.textContent = FormatedDateTime;

</script>