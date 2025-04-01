<div id="invoice-POS">
    <!-- {{--Print section--}} -->

    <div class="printed_content" style="text-align: center;">
        <center>
            <div class="logo">
                Daily Report
            </div>
            <hr>
        </center>

    </div>
    <div class="namedate">
        <!-- Name : <span class="space"></span> {{auth()->user()->name}} <br> -->
        <span class="namee">Name : <span class="space">{{auth()->user()->name}}</span> </span>
        <span class="datee">Date : <span id="date-time"></span></span>
        <br>
    </div>
    <!-- <div class="dashed-line">
    </div> -->
    <hr>
    <div class="detail">

        <table style="font-size: 9px; color:#666;">
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td class="txtbold">Pay In</td>
                <td>:</td>
                <td class="txtbold"><span class="space"></span> {{number_format(auth()->user()->payincash,2)}} </td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Pay Out</td>
                <td>:</td>
                <td class="txtbold"><span class="space"></span> {{number_format(auth()->user()->payoutcash,2)}}</td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>

            

            <tr>
                <td>Cash Payment</td>
                <td>:</td>
                <td><span class="space"></span> {{number_format(auth()->user()->cash -auth()->user()->payincash,2)}}</td>
            </tr>
            <tr>
                <td>Card Payment</td>
                <td>:</td>
                <td><span class="space"></span> {{number_format(auth()->user()->card,2)}}</td>
            </tr>
            <tr>
                <td>Bank Transfer</td>
                <td>:</td>
                <td><span class="space"></span> {{number_format(auth()->user()->bank,2)}}</td>
            </tr>
            <tr>
                <td>Consumer Credit</td>
                <td>:</td>
                <td><span class="space"></span> {{number_format(auth()->user()->consumer_credit,2)}}</td>
            </tr>

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>

            <tr class="txtbold">
                <td>Total sales price</td>
                <td>:</td>
                <td><span class="space"></span> {{number_format(auth()->user()->consumer_credit + auth()->user()->bank + auth()->user()->card + auth()->user()->cash + auth()->user()->payoutcash - auth()->user()->payincash ,2)}}</td>
            </tr>

            <tr>
                <td class="txtbold">Total amount in the drawer</td>
                <td>:</td>
                <td><span class="space"></span> <b>{{number_format(auth()->user()->hand_money,2)}}</b></td>
            </tr>
            <tr>
                <td>Bill Count</td>
                <td>:</td>
                <td><span class="space"></span> {{(auth()->user()->bill_count)}}</td>
            </tr>

            <tr>
                <td>Different</td>
                <td>:</td>
                <td><span class="space"></span> <b>{{number_format(auth()->user()->cash - auth()->user()->hand_money ,2)}}</b></td>
            </tr>

        </table>

        <style>
            .txtbold {
                font-weight: bold;
            }
        </style>


    </div>
    <hr>
    <div class="sign">
        <p style="margin-left:10px; font-size:9px;">..................... <br>
            &nbsp;&nbsp;&nbsp;signature
        </p>
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
        width: 100px;
        font-size: small;
        font-weight: bold;
        background-image: url() no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
        color: #333;
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
        font-size: 0.5em;
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

    .detail {
        margin-left: 10px;
    }

    .detail .space {
        display: inline-block;
        width: 20px;
    }

    .namedate {
        font-size: 9px;
        color: #444;
        width: 100%;
        overflow: hidden;
    }

    .datee {
        float: right;
        margin-right: 10px;
    }

    .namee {
        float: left;
        margin-left: 10px;
    }
</style>

<script>
    const DateTimeElement = document.getElementById('date-time');
    const CurrentDate = new Date();
    const FormatedDateTime = CurrentDate.toLocaleDateString() + ' ' + CurrentDate.toLocaleTimeString();
    DateTimeElement.textContent = FormatedDateTime;
</script>