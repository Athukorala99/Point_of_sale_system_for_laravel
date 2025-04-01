<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left; margin:4px;">Add Product Store(GRN)</h4>
                    </div>
                    <div class="card-body">
                        <div class="my-2">
                            <form action="" wire:keydown.arrow-right="InsertoCart">
                                <div class="row">

                                    <input type="text" class="form-control code" wire:model="product_code" name="code" id="code" placeholder="Barcode" style="width: 22%; margin-left:12px;"> &nbsp;
                                    
                                    <input type="number" class="form-control code" wire:model="qty" name="code" wire:model="qty" id="quan" placeholder="Enter Quantity" style="width: 24%;">&nbsp;

                                    <input type="number" class="form-control code" wire:model="qtyprice" name="code" wire:model="qty_price" id="qunprice" placeholder="Quantity Price" style="width: 24%;"> &nbsp;

                                    <input type="number" class="form-control code" name="code" wire:model="full_price" id="quanbalance" placeholder="Full Price" readonly style="width: 25%;">

                                </div>
                            </form>
                        </div>
                        @if (session()->has('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @elseif(session()->has('info'))
                        <div class="alert alert-info">{{session('info')}}</div>
                        @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif

                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th colspan="6">Total</th>
                                </tr>
                            </thead>
                            <tbody class="addMoreProduct">
                                <tr>
                                    @foreach ($addstorecart as $key=> $cart)
                                    <td class="no">{{$key +1}}</td>
                                    <td style="width:30%">
                                        <input type="text" value="{{$cart->product->product_name}} - {{$cart->product->barcode}}" name="" id="" class="form-control">
                                    </td>
                                    <td style="width:100px">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <button wire:click="IncrementQty({{$cart->id}})" class="btn btn-sm btn-success"> + </button>
                                            </div>
                                            <div class="col-md-2" style="text-align:center">
                                                <label for="" style="padding-left:2px">{{$cart->product_qty}}</label>
                                            </div>
                                            <div class="col-md-1" style="padding-left: 25px;">
                                                <button wire:click.prevent="DecrementQty({{$cart->id}})" class="btn btn-sm btn-danger"> - </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" value="{{$cart->product_price }}" name="price[]" id="price" class="form-control price" @if($cart->product->editprice == 0) readonly @endif >
                                    </td>

                                    <td>
                                        <input type="number" style="text-align: right;" readonly value="{{$cart->product_price * $cart->product_qty}}" name="total_amount[]" class="form-control total_amount">
                                    </td>

                                    <td><a href="#" class="btn btn-sm btn-danger" wire:click="removeProduct({{$cart->id}})"><i class="fa fa-times"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <h4 style="margin: 4px;  ">Total <b class="total ">Rs. {{$addstorecart->sum('total_price')}}</b></h4>

                    </div>
                    <form action=" {{route('addproductstore.store')}}" method="post" id="orderform">
                        @csrf
                        @foreach ($addstorecart as $key=> $cart)
                        <input type="hidden" value="{{$cart->product->id}}" name="product_id[]" class="form-control">
                        <input type="hidden" value="{{$cart->product_qty}}" name="quantity[]" class="form-control">
                        <input type="hidden" value="{{$cart->product_price}}" name="price[]" class="form-control price">
                        <input type="hidden" style="text-align: right;" value="{{$cart->product_price * $cart->product_qty}}" name="total_amount[]" class="form-control total_amount">
                        @endforeach
                        <input type="hidden" id="grn_total" value="{{$addstorecart->sum('total_price')}}" name="total" class="form-control">

                        <div class="card-body">
                            <div class="btn-group">
                                <button type="button" id="autoclickbtn" onclick="PrintReceptContent('print')" class="btn btn-dark"><i class="fa fa-print"></i>Print</button>
                            </div>
                            <div class="panel">
                                <div class="row">
                                    <table class="table table-striped">
                                        <tr style="width: fit-content; text-align: center; ">
                                            <td>
                                                <label for="">Date</label>
                                                <input type="date" class="form-control " name="date" wire:model="qty" id="code" placeholder="Date" required>
                                            </td>

                                            <td>
                                                <label for="">Invoice No</label>
                                                <input type="text" class="form-control " name="invoice_no" wire:model="invoice_no" id="code" placeholder="Invoice No" required>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-striped">
                                        <tr>
                                            <td>
                                                <label for="">Supplier</label>


                                                <input
                                                    type="text" name="supplier_phone" id="supplier_phone" class="form-control" list="supplier_phone_list" placeholder="Click to select a supplier phone" required />

                                                <datalist id="supplier_phone_list">
                                                    @if($suppliers->isEmpty())
                                                    <option value="No Supplier Found">
                                                        @else
                                                        @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->phone}}">
                                                        @endforeach
                                                        @endif

                                                </datalist>
                                            </td>
                                        </tr>
                                    </table>
                                    <span class="radio-item">
                                        <div class="search">
                                            <label>
                                                <input type="number" wire:model="discount" id="dis_amount" class="amount-input" name="discount" placeholder="Discount Amount" step="0.01">
                                                <i class="fa fa-money-bill text-success"></i>
                                            </label>
                                        </div>
                                    </span>

                                    </td>
                                    <hr style="width: 93%;">
                                    <td>
                                        <h4 style="font-size: 18px; font-weight:bold;">Balance &nbsp; &nbsp;&nbsp;&nbsp;<b><input type="number" id="balance" name="balance" readonly></b></h4>
                                    </td>
                                    <hr style="width: 93%;">
                                    <td>
                                        <button id="savebtn" class="btn-primary btn-lg btn-block mt-3" style="width:93%; margin-left:12px;">Save</button>
                                    </td>
                    </form>

                    <div style="display:flex; justify-content: space-between; align-items: center;">
                        <div class="listgrn" style="width: 45%; ">
                            <a href="{{route('grnview')}}" class="btn-warning btn-lg btn-block mt-2" style="text-decoration: none; height:50px; text-align:center;">
                                View List
                            </a>
                        </div>
                        <form action=" {{route('delorder.store')}}" method="post" style="width: 54%;">
                            @csrf
                            @foreach ($addstorecart as $key=> $cart)
                            <input type="hidden" value="{{$cart->product->id}}" name="product_id_del[]" class="form-control">
                            <input type="hidden" value="{{$cart->product_qty}}" name="quantity_del[]" class="form-control">
                            <input type="hidden" value="{{$cart->product_price / $cart->product_qty}}" name="price_del[]" class="form-control price">
                            <input type="hidden" value="{{$cart->product->price * $cart->product_qty }}" name="orginal_price_del[]" class="form-control orginal_price">
                            <input type="hidden" style="text-align: right;" value="{{$cart->product_price}}" name="total_amount_del[]" class="form-control total_amount">
                            @endforeach
                            <button class="btn-danger btn-lg btn-block mt-2">Cancel Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
    if ('{{auth()->user()->addstore_list}}' == '0') {
        var elements = document.getElementsByClassName('listgrn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'r') {
            document.getElementById('retail_price').checked = true;
        } else if (event.key === 'w') {
            document.getElementById('wholesale_price').checked = true;
        } else if (event.key === 's') {
            document.getElementById('special_price').checked = true;
        }
    });
</script>

<script>
    function toggleInput(checkbox) {
        const textInput = checkbox.nextElementSibling.nextElementSibling;
        // textInput.disabled = !checkbox.checked;
        if (checkbox.checked) {
            textInput.disabled = false;
        } else {
            textInput.disabled = true;
            textInput.value = "";
        }
    }

    document.getElementById("paid_amount").addEventListener("input", function() {
        let inputValue = this.value;
        document.getElementById("paymentamount").textContent = inputValue;
    });

    $('.total').on('DOMSubtreeModified', function() {
        var cash = parseFloat($('#cashcb').val()) || 0; // Convert to number, default to 0 if empty
        var bank = parseFloat($('#bankcb').val()) || 0;
        var credit = parseFloat($('#creditcb').val()) || 0;
        var total1 = parseFloat($('.total').text()) || 0; // Get the text content from .total element

        var totalPaid = cash + bank + credit; // Sum of cash, bank, and credit
        var balance = totalPaid - total1; // Calculate the balance

        $('#paid_amount').val(totalPaid.toFixed(2)); // Update the paid amount, rounded to 2 decimal places
        $('#balance').val(balance.toFixed(2)); // Update the balance, rounded to 2 decimal places
    });

    // Event listener for payment field changes
    $('#cashcb, #bankcb, #creditcb').on('input', function() {
        $('.total').trigger('DOMSubtreeModified');
    });


    //auto click the print button
    document.getElementById('savebtn').addEventListener('click', function() {
        setTimeout(function() {
            document.getElementById('autoclickbtn').click();
        });
    })
    //auto click the print button
</script>

<style>
    .radio-item {
        display: flex;
        justify-content: space-between;
        /* align-items: center; */
        margin-bottom: 7px;
    }

    .radio-item .amount-input {
        width: 100%;
        margin-right: 140px;
    }

    .amount-input {
        border-radius: 6px;
        border: 1px solid;
    }


    #paid_amount,
    #balance {

        border: none;
        background: none;
        outline: none;
        width: 70%;
        font: inherit;
        color: inherit;
        padding: 0;
        cursor: default;
        text-align: end;
    }


    .search {
        position: relative;
        width: 400px;
        margin: 0 10px;
    }

    .search label {
        position: relative;
        width: 100%;
    }

    .search label input {
        width: 100%;
        height: 35px;
        border-radius: 6px;
        padding: 5px 20px;
        padding-left: 50px;
        font-size: 16px;
        outline: 1px solid #E9E9E9;
        border: 1px solid var(--black2);
        /* text-align: end; */
    }

    .search label i {
        position: absolute;
        top: 8px;
        left: 15px;

        font-size: 18px;
    }

    .lbl {
        font-size: 15px;
    }
</style>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

@if(session('success'))
<script>
    // When the success message is available, trigger the print button click
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.getElementById('autoclickbtn').click(); // Click the print button
        }, 1000); // Adjust the timeout if necessary
    });
</script>
@endif