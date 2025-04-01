@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Add Supplier</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-toggle="modal" data-target="#addSupplier" id="addsupplierbtn"><i class="fa fa-plus"></i> Add New Supplier</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left" >

                            <thead>
                                <tr style="text-align: center;">
                                    <th>#</th>
                                    <th>Supplier Name</th>
                                    <th>Phone no</th>
                                    <th>Email</th>
                                    <th class="action">Action</th>
                                </tr>
                                <!-- <style>
                                    th:first-child {
                                        border-right-color: transparent;
                                    }
                                </style> -->
                            </thead>

                            <tbody>
                                @foreach($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$supplier->supplier_name}}</td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>{{$supplier->email}}</td>

                                    <td class="action">
                                        <div class="btn-group">
                                            <div class="editbtn">
                                                <a href="#" data-toggle="modal" data-target="#editSupplier{{$supplier->id}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            </div>
                                            &nbsp;
                                            <div class="deletebtn">
                                                <a href="#" data-toggle="modal" data-target="#deleteSupplier{{$supplier->id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- modal of edit supplier --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="editSupplier{{$supplier->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit Supplier</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('supplier.update',$supplier->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="name">Supplier Name</label>
                                                        <input type="text" name="supplier_name" value="{{$supplier->supplier_name}}" class="form-control" id="supplier_name" placeholder="Enter Supplier Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Address</label>
                                                        <input type="text" name="address" value="{{$supplier->address}}" class="form-control" id="address" placeholder="Enter Address" required> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Phone</label>
                                                        <input type="number" name="phone" value="{{$supplier->phone}}" class="form-control" id="phone" placeholder="Enter Phone" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Email</label>
                                                        <input type="email" name="email" value="{{$supplier->email}}" class="form-control" id="email" placeholder="Enter Email" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">
                                                            Update Supplier
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal of delete supplier --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="deleteSupplier{{$supplier->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete Supplier</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('supplier.destroy',$supplier->id )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete this {{$supplier->supplier_name}} ?</p>
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


                                {{ $suppliers->links() }}
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal of adding new supplier --}}

<!-- Modal -->
<div class="modal right fade" id="addSupplier" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('supplier.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Supplier Name</label>
                        <input type="text" name="supplier_name" class="form-control" id="supplier_name" placeholder="Enter Supplier Name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address Name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter Phone" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">
                            Save Supplier
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
</style>
<script>
    if ('{{auth()->user()->supplier_delete}}' == '0') {
        var elements = document.getElementsByClassName('deletebtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->supplier_edit}}' == '0') {
        var elements = document.getElementsByClassName('editbtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->supplier_add}}' == '0') {
        document.getElementById('addsupplierbtn').style.display = 'none';
    }

    if ('{{auth()->user()->supplier_delete}}' == '0' && '{{auth()->user()->supplier_edit}}' == '0') {
        var elements = document.getElementsByClassName('action');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
</script>
@endsection