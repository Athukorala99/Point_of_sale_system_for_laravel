@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Account balanace Confirmation</h4>
                        <p>
                            <a href="{{route('payinout.index')}}" style="float: right;" class="btn btn-warning"><i class="fa fa-reply"></i>Pay In/Out List View</a>
                        </p>
                    </div>
                    <div class="card-body">

                        <p>Name : {{$user->name}}</p>
                        <p>Email : {{$user->email}}</p>
                        <p>Phone No. : {{$user->contact}}</p>
                        <table class="table table-bordered table-left">
                            <tr>
                                <th>Pay In Cash</th>
                                <td>{{$user->payincash}}</td>
                            </tr>
                            <tr>
                                <th>Pay Out Cash</th>
                                <td>{{$user->payoutcash}}</td>
                            </tr>
                            <tr>
                                <th>Cash</th>
                                <td>{{$user->cash}}</td>
                            </tr>
                            <tr>
                                <th>Bank</th>
                                <td>{{$user->bank}}</td>
                            </tr>
                            <tr>
                                <th>Card</th>
                                <td>{{$user->card}}</td>
                            </tr>
                            <tr>
                                <th>Consumer Credit</th>
                                <td>{{$user->consumer_credit}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{$user->consumer_credit + $user->card + $user->bank + $user->cash}}</td>
                            </tr>
                            <tr>
                                <th>Total Sale</th>
                                <td>{{$user->consumer_credit + $user->card + $user->bank + $user->cash - $user->payincash}}</td>
                            </tr>
                            <tr>
                                <th>The money at hand</th>
                                <td>{{$user->hand_money}}</td>
                            </tr>
                            <tr>
                                <th>Difference</th>
                                <td>{{$user->cash - $user->hand_money}}</td>
                            </tr>
                            <tr>
                                <th>Bill Count</th>
                                <td>{{$user->bill_count}}</td>
                            </tr>
                        </table>
                        <div style="float: right;">
                            <form action="{{route('payout.update',$user->id )}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{$user->payincash}}" name="payincash" class="form-control">
                                <input type="hidden" value="{{$user->payoutcash}}" name="payoutcash" class="form-control">
                                <input type="hidden" value="{{$user->cash}}" name="cash" class="form-control">
                                <input type="hidden" value="{{$user->card}}" name="card" class="form-control">
                                <input type="hidden" value="{{$user->bank}}" name="bank" class="form-control">
                                <input type="hidden" value="{{$user->consumer_credit}}" name="consumer_credit" class="form-control">
                                <input type="hidden" value="{{$user->hand_money}}" name="hand_money" class="form-control">
                                <input type="hidden" value="{{$user->bill_count}}" name="bill_count" class="form-control">
                                <input type="hidden" value="{{$user->cash - $user->hand_money}}" name="different" class="form-control">

                                <button  type="submit" class="btn btn-success" style="float: left;"> OK</button>
                            </form>
                        </div>
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
@endsection