@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Add User</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-toggle="modal" data-target="#addUser" id="adduserbtn"><i class="fa fa-plus"></i> Add New User</a>
                    </div>
                    <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @elseif(session()->has('info'))
                        <div class="alert alert-info">{{session('info')}}</div>
                        @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
                        <table class="table table-bordered table-left">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    {{-- <th>Phone</th> --}}
                                    <th>Role</th>
                                    <th class="statusbtn">Status</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                @if($user->id == auth()->user()->id)
                                @else
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->is_admin == 1)Admin
                                        @else User
                                        @endif
                                    </td>
                                    <td class="statusbtn">
                                        <div class="statusbtn">
                                            <a href="userstatus/{{$user->id }}" class="btn btn-sm btn-{{$user->is_active ? 'success': 'danger'}}">
                                                {{$user->is_active ? 'Active': 'Inactive'}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="action">
                                        <div class="btn-group">
                                            <div class="editbtn">
                                                <a href="#" data-toggle="modal" data-target="#editUser{{$user->id}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            </div>
                                            &nbsp;
                                            <div class="deletebtn">
                                                <a href="#" data-toggle="modal" data-target="#deleteUser{{$user->id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                            </div>
                                            &nbsp;
                                            <div class="admin">
                                                <a href="#" data-toggle="modal" data-target="#permission{{$user->id}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>Permisson</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- modal of edit user --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="editUser{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('user.update',$user->id )}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" value="{{$user->name}}" class="form-control" id="name" placeholder="Enter Name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Email</label>
                                                        <input type="email" name="email" value="{{$user->email}}" class="form-control" id="email" placeholder="Enter Email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Phone</label>
                                                        <input type="text" name="contact" value="{{$user->contact}}" class="form-control" id="phone" placeholder="Enter Phone Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Password</label>
                                                        <input type="password" name="password" readonly value="{{$user->password}}" class="form-control" id="password" placeholder="Enter Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Role</label>
                                                        <select name="is_admin" id="" class="form-control">
                                                            <option value="1" @if($user->is_admin == 1) selected @endif>Admin</option>
                                                            <option value="0" @if($user->is_admin == 0) selected @endif>User</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">
                                                            Update User
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal of edit permission --}}

                                <!-- Modal -->
                                <div class="modal permission" id="permission{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog permissiond">
                                        <div class="modal-content permissionc">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Permission Update</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('permission.update',$user->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="home">Home</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="home_view" type="checkbox" value="1" id="flexSwitchCheckDefault" @if($user->home_view == '1') checked @endif>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Order</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="order_view" type="checkbox" value="1" id="flexSwitchCheckDefault" @if($user->order_view == '1') checked @endif>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">User</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="user_view" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="userallon(this)" @if($user->user_view == '1') checked @endif>&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="box" type="checkbox" id="user_add" name="user_add" value="1" @if($user->user_add == '1') checked @endif>&nbsp; Add&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="box" type="checkbox" id="user_edit" name="user_edit" value="1" @if($user->user_edit == '1') checked @endif>&nbsp; Edit&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="box" type="checkbox" id="user_delete" name="user_delete" value="1" @if($user->user_delete == '1') checked @endif>&nbsp; Delete&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="box" type="checkbox" id="user_status" name="user_status" value="1" @if($user->user_status == '1') checked @endif>&nbsp; Status&nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Product</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="product_view" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="productallon(this)" @if($user->product_view == '1') checked @endif>&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="box" type="checkbox" id="product_add" name="product_add" value="1" @if($user->product_add == '1') checked @endif>&nbsp; Add&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="box" type="checkbox" id="product_edit" name="product_edit" value="1" @if($user->product_edit == '1') checked @endif>&nbsp; Edit&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="box" type="checkbox" id="product_delete" name="product_delete" value="1" @if($user->product_delete == '1') checked @endif>&nbsp; Delete&nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Category</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="category_view" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="categoryallon(this)" @if($user->caregory_view == '1') checked @endif>&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxadd" type="checkbox" id="category_add" name="category_add" value="1" @if($user->caregory_add == '1') checked @endif>&nbsp; Add&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxedit" type="checkbox" id="category_edit" name="category_edit" value="1" @if($user->caregory_edit == '1') checked @endif>&nbsp; Edit&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxdelete" type="checkbox" id="category_delete" name="category_delete" value="1" @if($user->caregory_delete == '1') checked @endif>&nbsp; Delete&nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Supplier</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="supplier_view" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="supplierallon(this)" @if($user->supplier_view == '1') checked @endif>&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxadd" type="checkbox" id="supplier_add" name="supplier_add" value="1" @if($user->supplier_add == '1') checked @endif>&nbsp; Add&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxedit" type="checkbox" id="supplier_edit" name="supplier_edit" value="1" @if($user->supplier_edit == '1') checked @endif>&nbsp; Edit&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxdelete" type="checkbox" id="supplier_delete" name="supplier_delete" value="1" @if($user->supplier_delete == '1') checked @endif>&nbsp; Delete&nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Customer</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="customer_view" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="customerallon(this)" @if($user->customer_view == '1') checked @endif>&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxadd" type="checkbox" id="customer_add" name="customer_add" value="1" @if($user->customer_add == '1') checked @endif>&nbsp; Add&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxedit" type="checkbox" id="customer_edit" name="customer_edit" value="1" @if($user->customer_edit == '1') checked @endif>&nbsp; Edit&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxdelete" type="checkbox" id="customer_delete" name="customer_delete" value="1" @if($user->customer_delete == '1') checked @endif>&nbsp; Delete&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxpay" type="checkbox" id="customer_pay" name="customer_pay" value="1" @if($user->customer_pay == '1') checked @endif>&nbsp; Pay&nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Payin</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="payin_out" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="payinoutallon(this)" @if($user->payin_out == '1') checked @endif>&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxadd" type="checkbox" id="payin" name="payin" value="1" @if($user->payin == '1') checked @endif>&nbsp; Pay In&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxedit" type="checkbox" id="handmoney" name="handmoney" value="1" @if($user->handmoney == '1') checked @endif>&nbsp; Hand Money&nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Add Stock</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="addstore_view" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="addstockallon(this)" @if($user->addstore_view == '1') checked @endif>&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxadd" type="checkbox" id="addstore" name="addstore_list" value="1" @if($user->addstore_list == '1') checked @endif>&nbsp; GRN List&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <input class="boxedit" type="checkbox" id="quick_addstore" name="addstore_bill" value="1" @if($user->addstore_bill == '1') checked @endif>&nbsp; Grn Bill view&nbsp; &nbsp; &nbsp; &nbsp;
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">
                                                            Update Permission
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal of delete user --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="deleteUser{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('user.destroy',$user->id )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete this {{$user->name}} ?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                {{ $users->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- modal of adding new user --}}

<!-- Modal -->
<div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.store')}}" method="post">
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
                        <input type="text" name="contact" class="form-control" id="phone" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter Confirm password" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Role</label>
                        <select name="is_admin" id="" class="form-control">
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">
                            Save User
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
    function userallon(userCheckbox) {
        const addCheckbox = document.getElementById('user_add');
        const editCheckbox = document.getElementById('user_edit');
        const deleteCheckbox = document.getElementById('user_delete');
        const statusCheckbox = document.getElementById('user_status');

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = userCheckbox.checked;
        editCheckbox.checked = userCheckbox.checked;
        deleteCheckbox.checked = userCheckbox.checked;
        statusCheckbox.checked = userCheckbox.checked;

        userCheckbox.value = userCheckbox.checked ? "1" : "0";
        addCheckbox.value = addCheckbox.checked ? "1" : "0";
        editCheckbox.value = editCheckbox.checked ? "1" : "0";
        deleteCheckbox.value = deleteCheckbox.checked ? "1" : "0";
        statusCheckbox.value = statusCheckbox.checked ? "1" : "0";

    }

    function categoryallon(categoryCheckbox) {
        const addCheckbox = document.getElementById('category_add');
        const editCheckbox = document.getElementById('category_edit');
        const deleteCheckbox = document.getElementById('category_delete');

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = categoryCheckbox.checked;
        editCheckbox.checked = categoryCheckbox.checked;
        deleteCheckbox.checked = categoryCheckbox.checked;
    }

    function productallon(productCheckbox) {
        const addCheckbox = document.getElementById('product_add');
        const editCheckbox = document.getElementById('product_edit');
        const deleteCheckbox = document.getElementById('product_delete');

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = productCheckbox.checked;
        editCheckbox.checked = productCheckbox.checked;
        deleteCheckbox.checked = productCheckbox.checked;
    }

    function supplierallon(supplierCheckbox) {
        const addCheckbox = document.getElementById('supplier_add');
        const editCheckbox = document.getElementById('supplier_edit');
        const deleteCheckbox = document.getElementById('supplier_delete');

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = supplierCheckbox.checked;
        editCheckbox.checked = supplierCheckbox.checked;
        deleteCheckbox.checked = supplierCheckbox.checked;
    }

    function customerallon(customerCheckbox) {
        const addCheckbox = document.getElementById('customer_add');
        const editCheckbox = document.getElementById('customer_edit');
        const deleteCheckbox = document.getElementById('customer_delete');
        const payCheckbox = document.getElementById('customer_pay');

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = customerCheckbox.checked;
        editCheckbox.checked = customerCheckbox.checked;
        deleteCheckbox.checked = customerCheckbox.checked;
        payCheckbox.checked = customerCheckbox.checked;
    }

    function payinoutallon(Payin_outCheckbox) {
        const addCheckbox = document.getElementById('payin');
        const deleteCheckbox = document.getElementById('handmoney');

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = Payin_outCheckbox.checked;
        deleteCheckbox.checked = Payin_outCheckbox.checked;
    }

    function addstockallon(add_stockCheckbox) {
        const addCheckbox = document.getElementById('addstore');
        const editCheckbox = document.getElementById('quick_addstore');

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = add_stockCheckbox.checked;
        editCheckbox.checked = add_stockCheckbox.checked;
    }

    if ('{{auth()->user()->is_admin}}' == '0') {
        var elements = document.getElementsByClassName('admin');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->user_edit}}' == '0') {
        var elements = document.getElementsByClassName('editbtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->user_delete}}' == '0') {
        var elements = document.getElementsByClassName('deletebtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->user_status}}' == '0') {
        var elements = document.getElementsByClassName('statusbtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->user_add}}' == '0') {
        document.getElementById('adduserbtn').style.display = 'none';
    }

    if ('{{auth()->user()->user_delete}}' == '0' && '{{auth()->user()->user_edit}}' == '0' && '{{auth()->user()->is_admin}}' == '0') {
        var elements = document.getElementsByClassName('action');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
</script>
@endsection