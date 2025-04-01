@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;">Add Products</h4>
                        <a href="#" style="float: right;" class="btn btn-dark" data-toggle="modal" data-target="#addProduct" id="adduserbtn"><i class="fa fa-plus"></i> Add New Product</a>
                    </div>
                    <div class="card-body">

                        <!-- search bar -->
                        <div class="search">
                            <form id="searchform" action="{{route('product.index')}}" method="get">
                                <label>
                                    <input type="text" id="searchinput" name="search" placeholder="Search..." value="{{ request()->input('search') }}">
                                    <span id="clearIcon" onclick="refreshinput()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                        &times; <!-- X symbol -->
                                    </span>
                                    <ion-icon name="search-outline"></ion-icon>

                                </label>
                            </form>
                        </div>
                        <!-- search bar -->
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
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Alert Stock</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products->isEmpty())
                                <tr>
                                    <td colspan="6" style="text-align: center; color: red;">
                                        No Products with this name
                                    </td>
                                </tr>
                                @else
                                @foreach($products as $key => $product)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td style="text-align: right;">{{number_format($product->price,2)}}</td>
                                    <td style="text-align: center;">{{$product->quantity}}</td>
                                    <td style="text-align: center;">
                                        @if($product->alert_stock >= $product->quantity) 
                                            <span class="badge badge-danger"> Low Stock > {{$product->alert_stock }}</span>
                                        @else 
                                            <span class="badge badge-success"> {{$product->alert_stock}} </span>
                                        @endif
                                    </td>



                                    <td class="action">
                                        <div class="btn-group">
                                            <div class="editbtn">
                                                <a href="#" data-toggle="modal" data-target="#editProduct{{$product->id}}" 
                                                class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            </div>
                                            &nbsp;
                                            <div class="deletebtn">
                                                <a href="#" data-toggle="modal" data-target="#deleteProduct{{$product->id}}" 
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a>
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
                                                        <label for="name">Barcode</label>
                                                        <input type="text" name="barcode" value="{{$product->barcode}}" class="form-control" id="barcode" placeholder="Enter Barcode" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Product Name</label>
                                                        <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" id="product_name" placeholder="Enter Product Name" required>
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
                                                        <label for="name">Price</label>
                                                        <input type="number" name="price" value="{{$product->price}}" class="form-control" id="price" placeholder="Enter Price" step="0.01" required>
                                                    </div>

                                                    <div class="box">
                                                        <input type="checkbox" id="editprice" class="box" name="editprice" value="1" style="text-align: right;" @if($product->editprice == 1) checked @endif>&nbsp; Editable Price
                                                    </div>



                                                    <div class="form-group">
                                                        <label for="name">Retail Price</label>
                                                        <input type="number" name="retail_price" value="{{$product->retail_price}}" class="form-control" id="retail_price" placeholder="Enter Retail Price" step="0.01" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">wholesale Price</label>
                                                        <input type="number" name="wholesale_price" value="{{$product->wholesale_price}}" class="form-control" id="wholesale_price" placeholder="Enter Wholesale Price" step="0.01" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Special Price</label>
                                                        <input type="number" name="special_price" value="{{$product->special_price}}" class="form-control" id="special_price" placeholder="Enter Special Price" step="0.01" required>
                                                    </div>





                                                    <div class="form-group">
                                                        <label for="name">Print Name</label>
                                                        <input type="text" name="print_name" value="{{$product->print_name}}" class="form-control" id="print_name" placeholder="Enter Print Name" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="name">Supplier Name</label>
                                                        <select name="supplier" id="supplier_id" class="form-control product_id">
                                                            @foreach($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}" @if($product->supplier == $supplier->id) selected @endif>
                                                                {{ $supplier->supplier_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>






                                                    <div class="form-group">
                                                        <label for="name">Quantity</label>
                                                        <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control" id="quantity" placeholder="Enter Quantity">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Alert Stock</label>
                                                        <input type="number" name="alert_stock" value="{{$product->alert_stock}}" class="form-control" id="alert_stock" placeholder="Enter Stock" required>
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
                                @endif



                                {{ $products->links() }}
                            </tbody>

                        </table>

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
                        <label for="name">Barcode</label>
                        <input type="text" name="barcode" class="form-control" id="barcode" placeholder="Enter Barcode" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name" required>
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
                        <label for="name">Price</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter Price" step="0.01" required>
                    </div>
                    <div class="box">
                        <input type="checkbox" id="editprice" class="box" name="editprice" value="1" style="text-align: right;">&nbsp; Editable Price
                    </div>

                    <div class="form-group">
                        <label for="name">Retail Price</label>
                        <input type="number" name="retail_price" class="form-control" id="retail_price" placeholder="Enter Retail Price" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Wholesale Price</label>
                        <input type="number" name="wholesale_price" class="form-control" id="wholesale_price" placeholder="Enter Wholesale Price" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Special Price</label>
                        <input type="number" name="special_price" class="form-control" id="special_price" placeholder="Enter Special Price" step="0.01" required>
                    </div>



                    <div class="form-group">
                        <label for="name">Print Name</label>
                        <input type="text" name="print_name" class="form-control" id="print_name" placeholder="Enter Print Name" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Supplier</label>
                        <select name="supplier" id="supplier_id" class="form-control product_id">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="name">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter Quantity">
                    </div>
                    <div class="form-group">
                        <label for="name">Alert Stock</label>
                        <input type="number" name="alert_stock" class="form-control" id="alert_stock" placeholder="Enter Alert Stock" required>
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




    /* From Uiverse.io by vishnupprajapat */
    .box {
        text-align: right;
    }

    .checkbox-wrapper-46 input[type="checkbox"] {
        display: none;
        visibility: hidden;
    }

    .checkbox-wrapper-46 .cbx {
        margin: auto;
        -webkit-user-select: none;
        user-select: none;
        cursor: pointer;
    }

    .checkbox-wrapper-46 .cbx span {
        display: inline-block;
        vertical-align: middle;
        transform: translate3d(0, 0, 0);
    }

    .checkbox-wrapper-46 .cbx span:first-child {
        position: relative;
        width: 18px;
        height: 18px;
        border-radius: 3px;
        transform: scale(1);
        vertical-align: middle;
        border: 1px solid #9098a9;
        transition: all 0.2s ease;
    }

    .checkbox-wrapper-46 .cbx span:first-child svg {
        position: absolute;
        top: 3px;
        left: 2px;
        fill: none;
        stroke: #ffffff;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 16px;
        stroke-dashoffset: 16px;
        transition: all 0.3s ease;
        transition-delay: 0.1s;
        transform: translate3d(0, 0, 0);
    }

    .checkbox-wrapper-46 .cbx span:first-child:before {
        content: "";
        width: 100%;
        height: 100%;
        background: #506eec;
        display: block;
        transform: scale(0);
        opacity: 1;
        border-radius: 50%;
    }

    .checkbox-wrapper-46 .cbx span:last-child {
        padding-left: 8px;
    }

    .checkbox-wrapper-46 .cbx:hover span:first-child {
        border-color: #506eec;
    }

    .checkbox-wrapper-46 .inp-cbx:checked+.cbx span:first-child {
        background: #506eec;
        border-color: #506eec;
        animation: wave-46 0.4s ease;
    }

    .checkbox-wrapper-46 .inp-cbx:checked+.cbx span:first-child svg {
        stroke-dashoffset: 0;
    }

    .checkbox-wrapper-46 .inp-cbx:checked+.cbx span:first-child:before {
        transform: scale(3.5);
        opacity: 0;
        transition: all 0.6s ease;
    }

    @keyframes wave-46 {
        50% {
            transform: scale(0.9);
        }
    }

    /* search bar  */

    .search {
        position: relative;
        width: 250px;
        margin: 0;
        float: right;
    }

    .search label {
        position: relative;
        width: 100%;
    }

    .search label input {
        width: 100%;
        height: 35px;
        border-radius: 20px;
        padding: 5px 20px;
        padding-left: 50px;
        font-size: 16px;
        outline: 1px solid #E9E9E9;
        border: 1px solid var(--black2);
    }

    .search label ion-icon {
        position: absolute;
        top: 8px;
        left: 15px;
        font-size: 18px;
    }

    /* search bar*/
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

    if ('{{auth()->user()->product_delete}}' == '0' && '{{auth()->user()->product_edit}}' == '0') {
        var elements = document.getElementsByClassName('action');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }

    //keypress event for search bar
    $(document).ready(function () {
    // Store a timer to limit the requests
    let timer;

    $('input[name="search"]').on('keyup', function () {
        clearTimeout(timer); // Clear the previous timer

        // Trigger the search action every second after typing stops
        timer = setTimeout(function () {
            $('form').submit(); // Automatically submits the form for search
        }, 1000); // 1 second delay
    });
});


    //clear search bar

    function refreshinput() {
        document.getElementById('searchinput').value = '';
        window.location.href = "{{ route('product.index') }}";
    }
</script>
@endsection

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>