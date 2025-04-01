@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Pay In User</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Cash</th>
                                    <th>Total</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td style="text-align: right;">{{number_format($user->cash,2)}}</td>
                                    <td style="text-align: right;">{{number_format($user->cash + $user->card + $user->bank + $user->consumer_credit,2)}}</td>
                                    <td class="action">
                                        <div class="btn-group">
                                            <div class="editbtn">
                                                <a href="#" data-toggle="modal" data-target="#payin{{$user->id}}" class="btn btn-success btn-sm payin"><i class="fa fa-redo"></i>Pay In</a>
                                            </div> &nbsp; &nbsp;
                                            <div class="moneybtn">
                                                <!-- <a href="#" data-toggle="modal" data-target="#payout{{$user->id}}" class="btn btn-sm btn-primary payout"><i class="fa fa-undo"></i>Pay Out</a> -->
                                                <a href="{{route('payout.show', $user->id)}}" class="btn btn-sm btn-info handmoney"><i class="fa fa-download"></i>Hand Money</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- modal of edit pay in --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="payin{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Pay In User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('payinout.update',$user->id )}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" value="{{$user->name}}" class="form-control" id="name" placeholder="Enter Name" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Pay In</label>
                                                        <input type="number" name="cash" value="{{number_format($user->cash,2)}}" class="form-control" id="cash" placeholder="Enter Amount" step="0.01">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">
                                                            Update Pay In
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal of delete pay --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="payout{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Pay Out User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('payout.edit',$user->id )}}" method="post">
                                                    @csrf
                                                    @method('get')
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" value="{{$user->name}}" class="form-control" id="name" placeholder="Enter Name" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Pay out</label>
                                                        <input type="number" name="Payoutcash" class="form-control" id="cash" placeholder="Enter Amount" step="0.01">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="name">Discription</label>
                                                        <input type="text" name="discription" class="form-control" id="name" placeholder="Enter Name">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-danger" type="submit"> Update Pay In</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Search User</h4>
                    </div>
                    <div class="card-body">
                        ........................
                    </div>
                </div>
            </div> -->
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

    .card-body table thead tr th {
        text-align: center;
    }

    .amt {
        margin-right: 40px;
    }
</style>
<script>
    if ('{{auth()->user()->payin}}' == '0') {
        var elements = document.getElementsByClassName('payin');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    
    if ('{{auth()->user()->handmoney}}' == '0') {
        var elements = document.getElementsByClassName('moneybtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->payin}}' == '0' && '{{auth()->user()->handmoney}}' == '0') {
        var elements = document.getElementsByClassName('action');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
</script>
@endsection