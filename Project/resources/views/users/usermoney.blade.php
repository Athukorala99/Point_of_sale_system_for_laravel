@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">The Money at Hand</h4> &nbsp; &nbsp; &nbsp; &nbsp; 
              <button type="button" class="btn btn-custom reportbtn " id="reportbtn" onclick="PrintReceptContent('dailyReport')"><i class="fa fa-print"></i>Print Daily Report</button>

                        <h4 class="float-right"><b>Rs. {{auth()->user()->hand_money}}</b></h4>

                    </div>
                    <div class="card-body">


                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th colspan="2"></th>
                                    <th style="text-align: center; width:10%">Count</th>
                                    <th style="text-align: center; width:20%">Sub Total</th>
                                    <th colspan="2"></th>
                                    <th style="text-align: center; width:10%">Count</th>
                                    <th style="text-align: center; width:20%">Sub Total</th>
                                </tr>
                                <tr>
                                    <th rowspan="4" style="text-align:center;">Coins</th>
                                    <th>1</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rsone"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rsonet"></td>


                                    <th rowspan="6" style="text-align:center;">Banknote</th>
                                    <th>20</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs20"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs20t"></td>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs2"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs2t"></td>

                                    <th>50</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs50"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs50t"></td>
                                </tr>
                                <tr>
                                    <th>5</th>
                                    <td> <input type="number" style="text-align: right;" class="form-control total_amount" id="rs5"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs5t"></td>

                                    <th>100</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs100"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs100t"></td>
                                </tr>
                                <tr>
                                    <th>10</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs10"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs10t"></td>

                                    <th>500</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs500"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs500t"></td>

                                </tr>
                                <tr>
                                    <td colspan="5"> </td>
                                    <th>1000</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs1000"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs1000t"></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <th>5000</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="rs5000"></td>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" readonly id="rs5000t"></td>
                                </tr>
                                <tr>
                                    <th colspan="3" style="text-align: right;">Total</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="cointotal" readonly></td>
                                    <th colspan="3" style="text-align: right;"> Total</th>
                                    <td><input type="number" style="text-align: right;" class="form-control total_amount" id="note_total" readonly></td>

                                </tr>

                                <tr>
                                    <th colspan="7" style="text-align: right;">Total Amount</th>
                                    <td><input type="number" name="hand_money" style="text-align: right;" class="form-control total_amount" id="total_money" readonly></td>

                                </tr>
                                </tbody>
                        </table>
                        <div style="float: right;">
                            <form action=" {{route('payinout.store')}}" method="post">
                                @csrf
                                @method('post')
                                <input type="hidden" name="handmoney" style="text-align: right;" class="form-control total_amount" id="total_moneyin">
                                <button class="btn btn-success" style="float: left;"><i class="fa fa-check"></i> Ok</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal">
    <div id="dailyReport">
        @include('printReport.DailyReport')
    </div>
</div>

<style>
     .reportbtn {
        background-color: #008B8B;
        color: #fff;
        /* float: left;
        margin-right: 25px;
        margin-top: 10px; */
        outline-color: #008B8B;
        text-decoration: none;
      }


      .reportbtn:active,
      .reportbtn:hover {
        background-color: #007878;
        color: #fff;
        text-decoration: none;

      }
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
    if ('{{auth()->user()->hand_money}}' == '0') {
        document.getElementById('reportbtn').style.display = 'none';
        var elements = document.getElementsByClassName('reportbtn');
        for (var i = 0; i < elements.length; i++) {
          elements[i].style.display = 'none';
        }
      }
      function PrintReceptContent(el) {
        // Create the button's HTML
        var data = '<input type="button" id="printPageButton" class="printPageButton" style="display:block; width:100%; border:none; background-color:#008B8B; color:#fff;padding:14px 28px; font-size:16px; cursor:pointer; text-align:center;" value="Print Receipt" onClick="window.print()">';

        // Add the content from the specified element
        data += document.getElementById(el).innerHTML;

        // Open a new window to print the receipt
        var myReceipt = window.open('', 'myReceipt', 'left=150,top=130,width=400,height=400');
        myReceipt.screenX = 0;
        myReceipt.screenY = 0;

        // Write the content to the new window
        myReceipt.document.write('<html><head><title>Print Receipt</title></head><body>');
        myReceipt.document.write(data);
        myReceipt.document.write('</body></html>');

        // Focus on the new window
        myReceipt.focus();

        // Automatically close the window after printing
        setTimeout(() => {
          myReceipt.close();
        }, 8000);
      }
    document.addEventListener('DOMContentLoaded', function() {
        // coin -------------------------------------
        const rsone = document.getElementById('rsone');
        const rsonet = document.getElementById('rsonet');

        const rs2 = document.getElementById('rs2');
        const rs2t = document.getElementById('rs2t');

        const rs5 = document.getElementById('rs5');
        const rs5t = document.getElementById('rs5t');

        const rs10 = document.getElementById('rs10');
        const rs10t = document.getElementById('rs10t');


        // note -------------------------------------
        const rs20 = document.getElementById('rs20');
        const rs20t = document.getElementById('rs20t');

        const rs50 = document.getElementById('rs50');
        const rs50t = document.getElementById('rs50t');

        const rs100 = document.getElementById('rs100');
        const rs100t = document.getElementById('rs100t');

        const rs500 = document.getElementById('rs500');
        const rs500t = document.getElementById('rs500t');

        const rs1000 = document.getElementById('rs1000');
        const rs1000t = document.getElementById('rs1000t');

        const rs5000 = document.getElementById('rs5000');
        const rs5000t = document.getElementById('rs5000t');

        // total--------------------------------------

        const cointotal = document.getElementById('cointotal');
        const total_money = document.getElementById('total_money');
        const note_total = document.getElementById('note_total');
        const total_moneyin = document.getElementById('total_moneyin');
        // coin -------------------------------------

        rsone.addEventListener('input', function() {
            const rsonee = parseFloat(rsone.value) || 0;
            rsonet.value = 1 * rsonee;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
        });

        rs2.addEventListener('input', function() {
            const rs2e = parseFloat(rs2.value) || 0;
            rs2t.value = 2 * rs2e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });

        rs5.addEventListener('input', function() {
            const rs5e = parseFloat(rs5.value) || 0;
            rs5t.value = 5 * rs5e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });


        rs10.addEventListener('input', function() {
            const rs10e = parseFloat(rs10.value) || 0;
            rs10t.value = 10 * rs10e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });
        // note -------------------------------------


        rs20.addEventListener('input', function() {
            const rs20e = parseFloat(rs20.value) || 0;
            rs20t.value = 20 * rs20e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });


        rs50.addEventListener('input', function() {
            const rs50e = parseFloat(rs50.value) || 0;
            rs50t.value = 50 * rs50e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });


        rs100.addEventListener('input', function() {
            const rs100e = parseFloat(rs100.value) || 0;
            rs100t.value = 100 * rs100e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });



        rs500.addEventListener('input', function() {
            const rs500e = parseFloat(rs500.value) || 0;
            rs500t.value = 500 * rs500e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });



        rs1000.addEventListener('input', function() {
            const rs1000e = parseFloat(rs1000.value) || 0;
            rs1000t.value = 1000 * rs1000e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });



        rs5000.addEventListener('input', function() {
            const rs5000e = parseFloat(rs5000.value) || 0;
            rs5000t.value = 5000 * rs5000e;
            // coin
            const rsoneet = parseFloat(rsonet.value) || 0;
            const rs2tt = parseFloat(rs2t.value) || 0;
            const rs5tt = parseFloat(rs5t.value) || 0;
            const rs10tt = parseFloat(rs10t.value) || 0;

            // note
            const rs20tt = parseFloat(rs20t.value) || 0;
            const rs50tt = parseFloat(rs50t.value) || 0;
            const rs100tt = parseFloat(rs100t.value) || 0;
            const rs500tt = parseFloat(rs500t.value) || 0;
            const rs1000tt = parseFloat(rs1000t.value) || 0;
            const rs5000tt = parseFloat(rs5000t.value) || 0;


            cointotal.value = rsoneet + rs2tt + rs5tt + rs10tt;
            note_total.value = rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_money.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;
            total_moneyin.value = rsoneet + rs2tt + rs5tt + rs10tt + rs20tt + rs50tt + rs100tt + rs500tt + rs1000tt + rs5000tt;

        });

    });

    function PrintReceptContent(el) {
        // Get the content from the specified element
        var content = document.getElementById(el).innerHTML;

        // Open a new window to print the receipt
        var myReceipt = window.open('', 'myReceipt', 'left=150,top=130,width=400,height=400');
        myReceipt.screenX = 0;
        myReceipt.screenY = 0;

        // Write the content to the new window
        myReceipt.document.write(`
            <html>
                <head>
                    <title>Daily Report</title>
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