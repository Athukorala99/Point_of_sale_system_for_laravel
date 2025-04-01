@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">GRN Bill</h4>
                        <p>
                            <a href="{{route('addproductstore.index')}}" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i> Add New GRN</a>
                            <a href="{{route('grnview')}}" style="float: right;" class="btn btn-warning"><i class="fa fa-reply"></i>GRN List View</a>
                        </p>
                    </div>
                    <div class="card-body">

                        <p>Bill No : {{$addstore->bill_number}}</p>
                        <p>Billing Date : {{$addstore->addstore_date}}</p>
                        <p>Bill Enter Date : {{$addstore->bill_date}}</p>
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Barcode </th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Avialable Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addstoredetails as $key => $addstoredetail)
                                <tr>

                                    <td style="text-align: center;">{{$addstoredetail->product->barcode}}</td>
                                    <td style="text-align: center;">{{$addstoredetail->product->product_name}}</td>
                                    <td style="text-align: center;">{{$addstoredetail->quantity}}</td>
                                    <td style="text-align: center;">{{$addstoredetail->stock_quantity}}</td>
                                    <td style="text-align: right;">{{$addstoredetail->unitprice}}</td>
                                    <td style="text-align: right;">{{$addstoredetail->amount}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5" style="text-align: right;">Total</th>
                                    <th style="text-align: right;">{{$addstore->amount + $addstore->discount}}</th>
                                </tr>
                                <tr>
                                    <th colspan="5" style="text-align: right;">Discount</th>
                                    <th style="text-align: right;">{{- $addstore->discount}}</th>
                                </tr>
                                <tr>
                                    <th colspan="5" style="text-align: right;">Amount</th>
                                    <th style="text-align: right;">{{$addstore->amount}}</th>
                                </tr>
                            </tbody>
                        </table>
                        <div style="float: right;">
                            <button class="btn btn-dark" style="float: left;" onclick="PrintReceptContent('grnbill')"><i class="fa fa-print"></i> Print Bill</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal">
    <div id="grnbill">
        @include('printReport.GrnReceipt')
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
    if ('{{auth()->user()->hand_money}}' == '0') {
        document.getElementById('reportbtn').style.display = 'none';
        var elements = document.getElementsByClassName('reportbtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }


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
                    <title>GRN Receipt</title>
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