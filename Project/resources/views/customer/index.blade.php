@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Add Customer</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-toggle="modal" data-target="#addcustomer" id="addcustomerbtn"><i class="fa fa-plus"></i> Add New Customer</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key => $customer)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>@if($customer->alert_amount <= $customer->amount) <span class="badge badge-danger"> {{$customer->amount }}</span>
                                            @else <span class="badge badge-success"> {{$customer->amount}} </span>
                                            @endif

                                    </td>
                                    <td class="action">
                                        <div class="btn-group">
                                            <div class="editbtn">
                                                <a href="#" data-toggle="modal" data-target="#editcustomer{{$customer->id}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            </div>
                                            &nbsp;
                                            <div class="deletebtn">
                                                <a href="#" data-toggle="modal" data-target="#deletecustomer{{$customer->id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                            </div> &nbsp;
                                            <div class="paybtn">
                                                <a href="{{route('customer.show',$customer->id)}}" class="btn btn-sm btn-success"><i class="fa fa-money-bill-wave"></i>Pay</a>
                                            </div>

                                        </div>
                                    </td>
                                </tr>

                                {{-- modal of edit customer --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="editcustomer{{$customer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit customer</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('customer.update',$customer->id )}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" value="{{$customer->name}}" class="form-control" id="name" placeholder="Enter Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Email</label>
                                                        <input type="email" name="email" value="{{$customer->email}}" class="form-control" id="email" placeholder="Enter Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Phone</label>
                                                        <input type="number" name="phone" value="{{$customer->phone}}" class="form-control" id="phone" placeholder="Enter Phone" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Address</label>
                                                        <input type="text" name="address" value="{{$customer->address}}" class="form-control" id="address" placeholder="Enter Address" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Amount</label>
                                                        <input type="number" name="amount" value="{{$customer->amount}}" class="form-control" id="amount" placeholder="Enter Amount" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Alert Amount</label>
                                                        <input type="number" name="alert_amount" value="{{$customer->alert_amount}}" class="form-control" id="alert_amount" placeholder="Enter Alert Amount" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">
                                                            Update customer
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                {{-- modal of delete customer --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="deletecustomer{{$customer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete Customer</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('customer.destroy',$customer->id )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete this {{$customer->name}} ?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                {{ $customers->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal of adding new Customer --}}

<div class="modal right fade" id="addcustomer" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('customer.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Amount</label>
                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Alert Amount</label>
                        <input type="text" name="alert_amount" class="form-control" id="alert_amount" placeholder="Enter Alert Amount" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">
                            Add Customer
                        </button>
                    </div>
                </form>
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
    if ('{{auth()->user()->customer_delete}}' == '0') {
        var elements = document.getElementsByClassName('deletebtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->customer_edit}}' == '0') {
        var elements = document.getElementsByClassName('editbtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->customer_pay}}' == '0') {
        var elements = document.getElementsByClassName('paybtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->customer_add}}' == '0') {
        document.getElementById('addcustomerbtn').style.display = 'none';
    }

    if ('{{auth()->user()->customer_delete}}' == '0' && '{{auth()->user()->customer_edit}}' == '0' && '{{auth()->user()->customer_pay}}' == '0') {
        var elements = document.getElementsByClassName('action');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
</script>
@endsection