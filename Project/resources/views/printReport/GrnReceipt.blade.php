<div id="invoice-POS">
    <!-- {{--Print section--}} -->

    <div class="printed_content" style="text-align: center;">
        <center>
            <div class="logo">
                GRN Receipt
            </div>
        </center>
    </div>
    <div class="dashed-line"></div>

    <div class="mid">
        <div class="info">

            <div>
                <table style="font-size: 8px; color:#666">

                    <tr>
                        <td class="tleft">INV.NO &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: &nbsp; {{$reciptno}} </td>
                        <td class="tright">SUPPLIER&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;: &nbsp; {{$suppliersr}} </td>
                    </tr>
                    <tr >
                        <td class="tleft">GRN.NO &nbsp;&nbsp; &nbsp; &nbsp; : &nbsp; {{$lastID}} </td>
                        <td class="tright">BILLING DATE&nbsp; : &nbsp; {{$billingdate}} </td>
                    </tr>
                     <style>
                        .tright{
                            text-align: left;
                            padding-left: 90px;
                        }
                        .tleft{
                            text-align: left;
                            padding-left: 15px;
                        }
                     </style>

                </table>
            </div>

        </div>
    </div>

    <div class="dashed-line"></div>


    <!-- End recipt -->
    <div class="bot">
        <div id="table">
            <table style="width: 100%;">
                <tr class="tabletitle" style="font-size: 20px; text-align: center;">
                    <td class="item">
                        <h2>Product</h2>
                    </td>
                    <td class="Hours">
                        <h2>Qty</h2>
                    </td>
                    <td class="itemp">
                        <h2>Unit_price</h2>
                    </td>

                    <td class="itemp">
                        <h2>Sub Total</h2>
                    </td>
                    <td class="items"></td>
                </tr>

                @foreach($order_recept as $recept)
                <tr class="">
                    <td class="tableitemo">
                        <p class="itemtext"> {{$recept->product->product_name}} </p>
                    </td>

                    <td class="tableitemo">
                        <p class="itemtext"> {{$recept->quantity}} </p>
                    </td>
                    <td class="tableitemr">
                        <p class="itemtext"> {{number_format($recept->unitprice,2)}} </p>
                    </td>

                    <td class="tableitemr">
                        <p class="itemtext"> {{number_format($recept->amount,2)}} </p>
                    </td>

                </tr>
                @endforeach

                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">Total</td>
                    <td class="Rate" colspan="2" style="text-align: right;">
                        Rs. {{number_format($order_recept->sum('amount'),2)}}
                    </td>
                </tr>

                @if(($order_recept->sum('amount') - $amount >0))
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">Discount</td>
                    <td class="Rate" colspan="2" style="text-align: right;">
                        Rs. {{number_format($discount,2)}}
                    </td>
                </tr>
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate">Balance</td>
                    <td class="Rate" colspan="2" style="text-align: right;">
                        Rs. {{number_format($amount,2)}}
                    </td>
                </tr>
                @endif

            </table>
            <div class="dashed-line"></div>
            
            <div class=" entercheck">
                <table style="width: 100%; ">
                    <tr class="ectr">
                        <td style="text-align: left ;">Enter By : {{auth()->user()->name}}</td>
                        <td style="text-align: right ;">Check By : ..............................</td>
                    </tr> 
                    <tr class="ectr">
                        <td>{{$createdate}} </td>
                        <td style="text-align: right ;">Date : ..............................</td>
                    </tr>                   
                </table>


            </div>

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

    #invoice-POS .itemp {
        width: 20mm;
    }

    #invoice-POS .items {
        width: 0.5mm;
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

    .detail {
        margin-left: 10px;
    }

    .detail .space {
        display: inline-block;
        width: 20px;
    }

    .entercheck .ectr{
        font-size: 10px;
        color: #666;
    }
</style>

<script>
    const DateTimeElement = document.getElementById('date-time');

    const CurrentDate = new Date();
    const FormatedDateTime = CurrentDate.toLocaleDateString() + ' ' + CurrentDate.toLocaleTimeString();

    DateTimeElement.textContent = FormatedDateTime;
</script>