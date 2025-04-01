<a href="" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline rounded-pill dropmenu " id="aadmin"><i class="fa fa-bars"></i></a>
<a href="{{route('admin')}}" class="btn btn-outline rounded-pill adminhome @if(request()->routeIs('admin')) active @endif" id="home_view"><i class="fa fa-home"></i>Home</a>
<a href="{{route('home')}}" class="btn btn-outline rounded-pill userhome @if(request()->routeIs('home')) active @endif" id="home_view"><i class="fa fa-home"></i>Home</a>
<a href="{{route('user.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('user.index')) active @endif" id="user_view"><i class="fa fa-user"></i>Users</a>
<a href="{{route('product.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('product.index')) active @endif" id="product_view"><i class="fa fa-box"></i>Products</a>
<a href="{{route('category.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('category.index')) active @endif" id="category_view"><i class="fa fa-th-list"></i>Category</a>
<a href="{{route('Order.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('Order.index')) active @endif" id="order_view"><i class="fa fa-laptop"></i>Cashire</a>
<a href="{{route('supplier.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('supplier.index')) active @endif" id="supplier_view"><i class="fa fa-industry"></i>Suppliers</a>
<a href="{{route('customer.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('customer.index')) active @endif @if(request()->routeIs('customer.show')) active @endif" id="customer_view"><i class="fa fa-users"></i>Customers</a>
<a href="{{route('payinout.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('payinout.index')) active @endif" id="payinout"><i class="fa fa-handshake"></i>Pay In</a>
<a href="{{route('addproductstore.index')}}" class="btn btn-outline rounded-pill @if(request()->routeIs('addproductstore.index')) active @endif @if(request()->routeIs('grnview')) active @endif  @if(request()->routeIs('addproductstore.show')) active @endif" id="addstock"><i class="fa fa-cart-arrow-down"></i>Add store</a>
<a href="{{route('report.index')}}" class="btn btn-outline rounded-pill adminhome @if(request()->routeIs('report.index')) active @endif" id="addstock"><i class="fa fa-file-pdf"></i>Reports</a>
<style>
    .btn-outline {
        border-color: #fff;
        color: #008B8B;
    }

    .btn-outline:hover {
        color: #fff;
        background: #008B8B;
    }

    a i {
        margin-right: 5px;
    }

    .btn-outline.active {
        color: #fff;
        background: #008B8B;
    }
</style>

<script>
    if ('{{auth()->user()->is_admin}}' == '1') {
        document.getElementById('aadmin').style.display = 'none';
        var elements = document.getElementsByClassName('userhome');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->is_admin}}' == '0') {
        document.getElementById('aadmin').style.display = 'none';
        var elements = document.getElementsByClassName('adminhome');
        for (var i = 0; i < elements.length; i++) {
            elements[i].style.display = 'none';
        }
    }
    if ('{{auth()->user()->home_view}}' == '0') {
        document.getElementById('home_view').style.display = 'none';
    }
    if ('{{auth()->user()->order_view}}' == '0') {
        document.getElementById('order_view').style.display = 'none';
    }
    if ('{{auth()->user()->product_view}}' == '0') {
        document.getElementById('product_view').style.display = 'none';
    }
    if ('{{auth()->user()->user_view}}' == '0') {
        document.getElementById('user_view').style.display = 'none';
    }
    if ('{{auth()->user()->caregory_view}}' == '0') {
        document.getElementById('category_view').style.display = 'none';
    }
    if ('{{auth()->user()->supplier_view}}' == '0') {
        document.getElementById('supplier_view').style.display = 'none';
    }
    if ('{{auth()->user()->customer_view}}' == '0') {
        document.getElementById('customer_view').style.display = 'none';
    }

    if ('{{auth()->user()->payin_out}}' == '0') {
        document.getElementById('payinout').style.display = 'none';
    }
    if ('{{auth()->user()->addstore_view}}' == '0') {
        document.getElementById('addstock').style.display = 'none';
    }
</script>