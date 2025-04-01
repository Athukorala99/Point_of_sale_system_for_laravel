@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">GRN View</h4>
                        <a href="{{route('addproductstore.index')}}" style="float: right;" class="btn btn-dark" id="adduserbtn"><i class="fa fa-plus"></i> Add New GRN</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Bill NO.</th>
                                    <th>Bill Date</th>
                                    <th>Supplier</th>
                                    <th>Discout</th>
                                    <th>Pay Amount</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addstores->reverse() as $key => $addstore)
                                <tr>
                                    <td>{{$addstore->bill_number}}</td>
                                    <td>{{$addstore->bill_date}}</td>
                                    <td>{{$addstore->suppliers->supplier_name}}</td>
                                    <td>{{$addstore->discount}}</td>
                                    <td>{{$addstore->amount}}</td>
                                    <td class="action">
                                        <div class="btn-group">
                                            <div class="billviewbtn">
                                            <a href="{{route('addproductstore.show',$addstore->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>View Bill</a>
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
    </div>
</div>

<script>
    if ('{{auth()->user()->addstore_bill}}' == '0') {
        var elements = document.getElementsByClassName('action');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
</script>

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

    .boxadd{
        width: 15px;
        height: 15px;
        padding-left: 500px;
    }
</style>
<script>
 

    
   
</script>
@endsection