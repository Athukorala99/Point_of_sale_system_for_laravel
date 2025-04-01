<div> @livewireScripts
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left; margin:4px;">Order Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="my-2">
                            <form action="" wire:keydown.arrow-right="InsertoCart_retail" wire:keydown.w="InsertoCart_wholesale" wire:keydown.s="InsertoCart_special">
                                <div class="row">
                                    <input type="number" class="form-control code" name="code" wire:model="product_code" id="code" placeholder="Enter Product code" style="width:70%; margin-left:10px"> &nbsp; &nbsp; &nbsp;
                                    <input type="number" class="form-control code" name="code" wire:model="qty" id="code" placeholder="Enter Quantity" style="width:25%">
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
                                    @foreach ($productIncart as $key=> $cart)
                                    <td class="no">{{$key +1}}</td>
                                    <td style="width:30%">
                                        <input type="text" value="{{$cart->product->product_name}} - {{$cart->product->barcode}}" name="" id="" class="form-control" readonly>
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
                                        <input type="number" value="{{$cart->product_price / $cart->product_qty}}" name="price[]" id="price" class="form-control price" @if($cart->product->editprice == 0) readonly @endif >
                                    </td>

                                    <td>
                                        <input type="number" style="text-align: right;" readonly value="{{$cart->product_price}}" name="total_amount[]" class="form-control total_amount">
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
                        <h4 style="margin: 4px;  ">Total <b class="total ">{{$productIncart->sum('product_price')}}</b></h4>

                        <h4 style="margin: 4px;  ">Discount <b class="total ">{{$productIncart->sum('discount')}}</b></h4>
                    </div>
                    <form action=" {{route('Order.store')}}" method="post" id="orderform">
                        @csrf
                        @foreach ($productIncart as $key=> $cart)
                        <input type="hidden" value="{{$cart->product->id}}" name="product_id[]" class="form-control">
                        <input type="hidden" value="{{$cart->product_qty}}" name="quantity[]" class="form-control">
                        <input type="hidden" value="{{$cart->product_price / $cart->product_qty}}" name="price[]" class="form-control price">
                        <input type="hidden" value="{{$cart->product->price * $cart->product_qty }}" name="orginal_price[]" class="form-control orginal_price">
                        <input type="hidden" value="{{$cart->product_price}}" name="total_amount[]" class="form-control total_amount">
                        @endforeach
                        <div class="card-body">
                            <div class="btn-group">
                                <button type="button" id="autoclickbtn" onclick="PrintReceptContent('print')" class="btn btn-dark"><i class="fa fa-print"></i>Print</button>
                                <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#holdlist"><i class="fa fa-print"></i>Hold List</button>
                            </div>
                            <div class="panel">
                                <div class="row">

                                    <!-- customer phone number selector -->
                                    <table class="table table-striped">
                                        <tr>
                                            <td>
                                                <label for="customer_phone">Customer Phone</label>
                                                <input type="text" name="customer_phone" id="customer_phone" class="form-control" list="customer_phone_list" placeholder="Click to select a customer phone" />

                                                <datalist id="customer_phone_list">
                                                    @foreach($customers as $customer)
                                                    <option value="{{$customer->phone}}"></option>
                                                    @endforeach
                                                </datalist>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- customer phone number selector -->

                                    <label class="lbl">Payment Types</label> <br>
                                    <span class="radio-item">
                                        <div class="search">
                                            <label>
                                                <input type="number" wire:model="cashtxt" id="cashcb" class="amount-input" name="cash" placeholder="Cash Amount" step="0.01">
                                                <i class="fa fa-money-bill text-success"></i>
                                            </label>
                                        </div>
                                    </span>
                                    <span class="radio-item">
                                        <div class="search">
                                            <label>
                                                <input type="number" wire:model="banktxt" id="bankcb" class="amount-input" name="bank" placeholder="Bank Transfer Amount" step="0.01">
                                                <i class="fa fa-university text-danger"></i>
                                            </label>
                                        </div>
                                    </span>
                                    <span class="radio-item">
                                        <div class="search">
                                            <label>
                                                <input type="number" wire:model="credittxt" id="creditcb" placeholder="Credit Card Amount" class="amount-input" name="credit_card" step="0.01">
                                                <i class="fa fa-credit-card text-info"></i>
                                            </label>
                                        </div>
                                    </span>
                                    </td>
                                    <hr style="width: 93%;">
                                    <td>
                                        <h4 style="font-size: 18px; font-weight:bold;">Payment &nbsp;&nbsp;&nbsp;<b><input type="number" wire:model="pay_money" id="paid_amount" name="paid_amount" readonly></b></h4>
                                    </td>
                                    <td>
                                        <h4 style="font-size: 18px; font-weight:bold;">Change &nbsp; &nbsp;&nbsp;&nbsp;<b><input type="number" wire:model="balance" id="balance" name="balance" readonly></b></h4>
                                    </td>
                                    <hr style="width: 93%;">
                                    <td>
                                        <button id="savebtn" class="btn-primary btn-lg btn-block mt-3" style="width:93%; margin-left:12px;">Save</button>
                                    </td>
                    </form>
                    <td style="display:flex; justify-content: space-between; align-items: center;">
                        <form action=" {{route('holdorder.store')}}"  method="post" style="width: 45%; ">
                            @csrf
                            @foreach ($productIncart as $key=> $cart)
                            <input type="hidden" value="{{$cart->product->id}}" name="product_id_hold[]" class="form-control">
                            <input type="hidden" value="{{$cart->product_qty}}" name="quantity_hold[]" class="form-control">
                            <input type="hidden" value="{{$cart->barcode}}" name="barcode[]" class="form-control">
                            <input type="hidden" value="{{$cart->discount}}" name="discount[]" class="form-control">
                            <input type="hidden" value="{{$cart->product_price / $cart->product_qty}}" name="price_hold[]" class="form-control price">
                            <input type="hidden" value="{{$cart->product->price * $cart->product_qty }}" name="orginal_price_hold[]" class="form-control orginal_price">
                            <input type="hidden" style="text-align: right;" value="{{$cart->product_price}}" name="total_amount_hold[]" class="form-control total_amount">
                            @endforeach
                            <button class="btn-warning btn-lg btn-block mt-2" style="width:150px; ">Hold</button>
                        </form>

                        <form action=" {{route('delorder.store')}}" method="post" style="width: 55%;">
                            @csrf
                            @foreach ($productIncart as $key=> $cart)
                            <input type="hidden" value="{{$cart->product->id}}" name="product_id_del[]" class="form-control">
                            <input type="hidden" value="{{$cart->product_qty}}" name="quantity_del[]" class="form-control">
                            <input type="hidden" value="{{$cart->product_price / $cart->product_qty}}" name="price_del[]" class="form-control price">
                            <input type="hidden" value="{{$cart->product->price * $cart->product_qty }}" name="orginal_price_del[]" class="form-control orginal_price">
                            <input type="hidden" style="text-align: right;" value="{{$cart->product_price}}" name="total_amount_del[]" class="form-control total_amount">
                            @endforeach
                            <button class="btn-danger btn-lg btn-block mt-2">Cancel Order</button>
                        </form>
                    </td>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


{{-- modal of adding new product --}}
<div class="modal right fade" id="holdlist" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Hold List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-left">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holdlists as $key => $holdlist)

                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$holdlist->id}}</td>
                            <td>{{$holdlist->date}}</td>
                            <td>
                                <div class="btn-group">
                                    <div class="editbtn">
                                        <form action="{{route('holdorder.update',$holdlist->id )}}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" value="{{$holdlist->id}}" name="holdlist_id[]" class="form-control">
                                            <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Add card</button>
                                        </form>
                                    </div>
                                    <div class="deletebtn">
                                        <form action="{{route('holdorder.destroy',$holdlist->id )}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" value="{{$holdlist->id}}" name="holdlist_id[]" class="form-control">
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
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