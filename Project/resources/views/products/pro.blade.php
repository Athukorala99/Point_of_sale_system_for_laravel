@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Add Products</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-toggle="modal" data-target="#addProduct" id="adduserbtn"><i class="fa fa-plus"></i> Add New Product</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Barnd</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Alert Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td >{{$product->product_name}}</td>
                                    <td>{{$product->brand}}</td>
                                    <td style="text-align: right;">{{number_format($product->price,2)}}</td>
                                    <td style="text-align: center;">{{$product->quantity}}</td>
                                    <td style="text-align: center;">@if($product->alert_stock >= $product->quantity) <span class="badge badge-danger"> Low Stock > {{$product->alert_stock }}</span>
                                        @else <span class="badge badge-success"> {{$product->alert_stock}} </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group">
                                            <div class="editbtn">
                                                <a href="#" data-toggle="modal" data-target="#editProduct{{$product->id}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            </div>
                                            <div class="deletebtn">
                                                <a href="#" data-toggle="modal" data-target="#deleteProduct{{$product->id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                {{-- modal of edit product --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="editProduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit Product</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('product.update',$product->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="name">Product Name</label>
                                                        <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" id="product_name" placeholder="Enter Product Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Category Name</label>
                                                        <select name="category" id="category_id" class="form-control product_id">
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" @if($product->category == $category->id) selected @endif>
                                                                {{ $category->category_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Brand</label>
                                                        <input type="text" name="brand" value="{{$product->brand}}" class="form-control" id="brand" placeholder="Enter Brand Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Price</label>
                                                        <input type="number" name="price" value="{{$product->price}}" class="form-control" id="price" placeholder="Enter Price">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Quantity</label>
                                                        <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control" id="quantity" placeholder="Enter Quantity">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Alert Stock</label>
                                                        <input type="number" name="alert_stock" value="{{$product->alert_stock}}" class="form-control" id="alert_stock" placeholder="Enter Stock">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Description</label>
                                                        <textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="Enter Description">{{$product->description}}</textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-block">
                                                            Update Product
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal of delete product --}}

                                <!-- Modal -->
                                <div class="modal right fade" id="deleteProduct{{$product->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete product</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                {{$product->id}}
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('product.destroy',$product->id )}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete this {{$product->product_name}} ?</p>
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


                                {{ $products->links() }}
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Search Product</h4>
                    </div>
                    <div class="card-body">
                        ........................
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal of adding new product --}}

<!-- Modal -->
<div class="modal right fade" id="addProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('product.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name">
                    </div>

                    <div class="form-group">
                        <label for="name">Category</label>
                        <select name="category" id="category_id" class="form-control product_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Brand</label>
                        <input type="text" name="brand" class="form-control" id="brand" placeholder="Enter Brand Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Price</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="name">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity">
                    </div>
                    <div class="form-group">
                        <label for="name">Alert Stock</label>
                        <input type="number" name="alert_stock" class="form-control" id="alert_stock" placeholder="Enter Alert Stock">
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="Enter Description"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary btn-block">
                            Save Product
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
    if ('{{auth()->user()->product_delete}}' == '0') {
        var elements = document.getElementsByClassName('deletebtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->product_edit}}' == '0') {
        var elements = document.getElementsByClassName('editbtn');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->product_add}}' == '0') {
        document.getElementById('adduserbtn').style.display = 'none';
    }
</script>
@endsection