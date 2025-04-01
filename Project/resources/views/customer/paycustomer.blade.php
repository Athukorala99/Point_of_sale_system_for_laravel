@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Pay Customer</h4>
                    </div>
                    <div class="card-body">
                        <p>Name : {{$customer->name}}</p>
                        <p>Tel : {{$customer->phone}}</p>
                        <p>Email : {{$customer->email}}</p>

                        <hr>
                        <div class="form-group">
                            <label for="name"> Amount</label>
                            <input type="number" name="pamount" value="{{$customer->amount }}" class="form-control pamount" id="pamount" placeholder="Enter Alert Amount" readonly>
                        </div>
                        <form action="{{route('paycustomer.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Paying Amount</label>
                                <input type="number" name="customer_id" class="form-control" id="customer_id" placeholder="Enter Customer ID" value="{{$customer->id }}" hidden>
                                <input type="number" name="aamount" value="{{$customer->amount }}" class="form-control" id="aamount" placeholder="Enter  Amount" hidden>
                                <input type="number" name="ppaying_amount" class="form-control ppaying_amount" id="ppaying_amount" placeholder="Enter Paying Amount">
                            </div>
                            <div class="form-group">
                                <label for="name"> Balance</label>
                                <input type="number" name="pbalance" class="form-control pbalance" id="pbalance" placeholder="your balance" readonly>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Pay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">History</h4>
                        <a href="{{route('customer.index')}}" class="btn btn-primary float-right btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Bill No.</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customerhistories->reverse() as $key => $customerhistory)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$customerhistory->date}}</td>
                                    <td>{{$customerhistory->billno}}</td>
                                    <td>{{$customerhistory->amount}}</td>
                                    <td>{{$customerhistory->balance}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const pamount = document.getElementById('pamount');
        const ppaying_amount = document.getElementById('ppaying_amount');
        const pbalance = document.getElementById('pbalance');

        ppaying_amount.addEventListener('input', function() {
            const amount = parseFloat(pamount.value) || 0;
            const paying_amount = parseFloat(ppaying_amount.value) || 0;
            pbalance.value = amount - paying_amount;
        });
    });
</script>


@endsection