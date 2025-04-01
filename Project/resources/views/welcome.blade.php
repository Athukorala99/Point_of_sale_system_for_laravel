<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body>

    <div class="container">
        <div class="image">
            <img src="{{ asset('images/cashire.png') }}" alt="">
        </div>
        <div class="text-section" style="text-align: center;">
            <h2>One System One Option</h2>
            <hr>
            <p>Welcome to our supermarket! Enjoy a wide selection of fresh produce, groceries, and essentials at great prices. We’re dedicated to providing quality products and friendly service for you and your family!</p>



            @if (Route::has('login'))

            @auth

            @if(auth()->user()->is_admin==0)
            <a href="{{ url('cashire/home') }}">
                <button class="btn-login cashier" style="height: 40px;">Home</button>
            </a>
            @else
            <a href="{{ url('/home') }}"><button class="btn-login admin" style="height: 40px;">Home</button></a>
            @endif

            @else
            <a class="nav-link" href="{{ route('login') }}"><button class="btn-login" style="height: 40px;">Login / Register</button></a>

            @endauth
        </div>
        @endif


    </div>




</body>

</html>

<style>
    /* body {
        background-image: url({{ asset('images/back3.png')}});
        background-size: cover;
        background-repeat: no-repeat;

    } */

    body {
        background-color: #e2e2e2;
        /* background: linear-gradient(to left, #e2e2e2, #c9d6ff); */
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-top: 3%;
    }

    .image img {
        margin-top: 10%;
        width: 2000px;
        max-width: 100%;
        /* transform: scalex(-1); */
    }

    h2 {
        font-size: 40px;
        text-align: center;
        margin: 0;
        margin-top: 15%;
        margin-right: 10%;
        /* margin-left: 5%; */
        z-index: 1;
        color: #333;
    }

    p {
        font-size: 23px;
        text-align: center;
        margin: 0;
        margin-top: 5%;
        margin-right: 10%;
        color: #333;
    }

    hr {
        width: 200px;
        margin-right: 39%;
        border: none;
        border-top: 5px solid #3AB08A;
        border-radius: 10px;
    }

    .btn-login {

        height: 20px;
        width: 180px;
        border: 2px solid #3AB08A;
        border-radius: 15px;
        color: #3AB08A;
        z-index: 1;
        background: transparent;
        position: relative;
        font-weight: 1000;
        font-size: 17px;
        transition: all 250ms;
        overflow: hidden;
        margin-right: 10%;
        margin-top: 40px;

    }

    .btn-login::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 0;
        border-radius: 0px;
        background-color: #3AB08A;
        z-index: -1;
        -webkit-box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        box-shadow: 4px 8px 19px -3px rgba(0, 0, 0, 0.27);
        transition: all 250ms
    }

    .btn-login:hover {
        color: #fff;
        cursor: pointer;
    }

    .btn-login:hover::before {
        width: 100%;
    }
</style>
