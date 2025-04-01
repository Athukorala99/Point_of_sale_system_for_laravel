@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Add Products</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-toggle="modal" data-target="#addProduct"><i class="fa fa-plus"></i> Add New Product</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>User Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $key => $permission)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$permission->user->email}}</td>

                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal" data-target="#editpermission{{$permission->id}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Update</a>
                                        </div>
                                    </td>
                                </tr>

                                {{-- modal of edit product --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="editpermission{{$permission->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Permission Update</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('permission.update',$permission->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="home">Home</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="home_view" type="checkbox" value="1" id="flexSwitchCheckDefault" @if($permission->home_view == '1') checked @endif>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Order</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="order_view" type="checkbox" value="1" id="flexSwitchCheckDefault" @if($permission->order_view == '1') checked @endif>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">User</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="user_view" type="checkbox" id="flexSwitchCheckDefault" value="1" onchange="userallon(this)" @if($permission->user_view == '1') checked @endif>
                                                            <input class="box" type="checkbox" id="user_add" name="user_add" value="1" @if($permission->user_add == '1') checked @endif>&nbsp; Add
                                                            <input class="box" type="checkbox" id="user_edit" name="user_edit" value="1" @if($permission->user_edit == '1') checked @endif>&nbsp;  Edit
                                                            <input class="box" type="checkbox" id="user_delete" name="user_delete" value="1" @if($permission->user_delete == '1') checked @endif>&nbsp; Delete
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Productr</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="product_view" type="checkbox" id="flexSwitchCheckDefault" value="1"  onchange="productallon(this)" @if($permission->product_view == '1') checked @endif>
                                                            <input class="box" type="checkbox" id="product_add" name="product_add" value="1" @if($permission->product_add == '1') checked @endif>&nbsp; Add
                                                            <input class="box" type="checkbox" id="product_edit" name="product_edit" value="1" @if($permission->product_edit == '1') checked @endif>&nbsp; Edit
                                                            <input class="box" type="checkbox" id="product_delete" name="product_delete" value="1" @if($permission->product_delete == '1') checked @endif>&nbsp; Delete
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="home">Caregory</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="category_view" type="checkbox" id="flexSwitchCheckDefault" value="1"   onchange="categoryallon(this)" @if($permission->caregory_view == '1') checked @endif>
                                                            <input class="boxadd" type="checkbox" id="category_add" name="category_add" value="1" @if($permission->caregory_add == '1') checked @endif>&nbsp; Add
                                                            <input class="boxedit" type="checkbox" id="category_edit" name="category_edit" value="1" @if($permission->caregory_edit == '1') checked @endif>&nbsp; Edit
                                                            <input class="boxdelete" type="checkbox" id="category_delete" name="category_delete" value="1" @if($permission->caregory_delete == '1') checked @endif>&nbsp; Delete
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

    .boxadd{
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

        // Check or uncheck all based on the user checkbox state
        addCheckbox.checked = userCheckbox.checked;
        editCheckbox.checked = userCheckbox.checked;
        deleteCheckbox.checked = userCheckbox.checked;

        userCheckbox.value = userCheckbox.checked ? "1" : "0";
        addCheckbox.value = addCheckbox.checked ? "1" : "0";
        editCheckbox.value = editCheckbox.checked ? "1" : "0";
        deleteCheckbox.value = deleteCheckbox.checked ? "1" : "0";

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
    if ($permission.category_add == 1)
        {
            alert('Hello');
        }
    
        
    endif
re
</script>
@endsection