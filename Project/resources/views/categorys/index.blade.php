@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Add Category</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-toggle="modal" data-target="#addProduct" id="adduserbtn"><i class="fa fa-plus"></i> Add New Category</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>

                                <tr style="text-align: center;">
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$category -> category_name}}</td>
                                    <td class="action">
                                        <div class="btn-group">
                                            <div class="editbtn">
                                                <a href="#" data-toggle="modal" data-target="#editCat{{$category->id}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            </div> 
                                            &nbsp;
                                            <div class="deletebtn">
                                                <a href="#" data-toggle="modal" data-target="#deleteCat{{$category->id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- modal of edit Category --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="editCat{{$category->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit Category</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('category.update',$category->id )}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="name">Category Name</label>
                                                        <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control" id="category_name" placeholder="Enter Category Name" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">
                                                            Update Category
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal of delete Category --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="deleteCat{{$category->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete category</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                {{$category->id}}
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('category.destroy',$category->id )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete this {{$category->category_name}} ?</p>
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

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal of adding new category --}}

<!-- Modal -->
<div class="modal right fade" id="addProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('category.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter Category Name" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">
                            Save Category
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
    if ('{{auth()->user()->caregory_delete}}' == '0') {
        var elements = document.getElementsByClassName('deletebtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->caregory_edit}}' == '0') {
        var elements = document.getElementsByClassName('editbtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if('{{auth()->user()->caregory_add}}' == '0'){
        document.getElementById('adduserbtn').style.display = 'none';
    }

    if('{{auth()->user()->caregory_delete}}' == '0' && '{{auth()->user()->caregory_edit}}' == '0'){
        var elements = document.getElementsByClassName('action');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
</script>
@endsection