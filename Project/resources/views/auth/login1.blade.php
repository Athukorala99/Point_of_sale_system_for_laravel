@extends('layouts.first')
@section('content')


<!-- @vite('resources/css/stylelogin.css') -->
@vite('resources/js/logReg.js')


<!-- <link rel="stylesheet" href="{{ asset('resources/css/stylelogin.css') }}"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<a href="{{ url('/') }}">
    <button class="button" style="--clr: #008b8b;">
        <span class="button-decor"></span>
        <div class="button-content">
            <div class="button__icon">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="svg-snoweb svg-theme-dark"
                    x="0"
                    y="0"
                    width="100%"
                    height="100%"
                    viewBox="0 0 100 100"
                    preserveAspectRatio="xMidYMid meet">
                    <defs>

                    </defs>


                    <clipPath id="clip-path-202409-1608-0822-91be95ac-388a-4c3f-89ea-85db71e3bd03">
                        <rect x="0" y="95" width="100" height="5"></rect>
                    </clipPath>
                    <g clip-path="url(#clip-path-202409-1608-0822-91be95ac-388a-4c3f-89ea-85db71e3bd03)">
                        <rect opacity="0.25" filter="url(#svg-filter-glass)"
                            class="svg-fill-tertiary"
                            x="0"
                            y="95"
                            width="100"
                            height="5">
                        </rect>
                        <g transform="translate(0, 50)">
                            <circle opacity="0.25" filter="url(#svg-filter-glass)"
                                class="svg-fill-secondary svg-builder-circle"
                                cx="50"
                                cy="50"
                                r="50">
                            </circle>
                        </g>
                    </g>

                    <g transform="translate(20.00, 20.00) scale(0.60, 0.60)">

                        <path d="M43.3,73.5,19.8,50m0,0L43.3,26.5M19.8,50H80.2" fill="none" class="svg-stroke-primary" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="8" />


                    </g>
                </svg>
            </div>
            <span class="button__text">Home</span>
        </div>
    </button>
</a>

<div class="container" id="container">
    <div class="form-container sign-up regi">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Register</h1><br>

            <input id="name" placeholder="Your Name" type="text" class="form-control @error('name') is-invalid @enderror size" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="email" placeholder="E-Mail Address" type="email" class="form-control @error('email') is-invalid @enderror size" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror


            <input id="contact" placeholder="Mobile Number" type="tel" class="form-control @error('contact') is-invalid @enderror size" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus  maxlength="10"
             inputmode="numeric" onkeypress="return isNumberKey(event)" oninput="this.value = this.value.slice(0, 10);">

            @error('contact')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror


            <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror size" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input id="password-confirm" placeholder="Re-Enter Password" type="password" class="form-control size" name="password_confirmation" required autocomplete="new-password">

            <button type="submit" class="btn btn-primary buton">{{ __('Register') }}</button>
        </form>
    </div>

    <div class="form-container sign-in">

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Sign In</h1>
            <br>
            <!-- <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin"></i></a>
                </div>
                <span>or use your email password</span> -->

            <input id="email" type="email" placeholder="E-Mail Address" class="form-control @error('email') is-invalid @enderror size " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- <input type="email" placeholder="email" >
                <input type="password" placeholder="Password" > -->

            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror size" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror


            <!-- <input class="form-check-input checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}                        
                    </label> -->

            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Password ?') }}
            </a>
            @endif


            <!-- <a href="#"> Forget Your Password?</a> -->
            <button type="submit" class="btn btn-primary buton">{{ __('login') }}</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back</h1>
                <p>Enter Your Personal Details to use all of site features</p>
                <button type="button" class="hidden" id="login"> sign In </button>

            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hello, friend!</h1>
                <p>Register with Your Personal Details to use all of site features</p>
                <button type="button" class="hidden" id="register"> sign Up </button>
            </div>
        </div>
    </div>
</div>



<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background-color: #c9d6ff;
        background: linear-gradient(to right, #e2e2e2, #c9d6ff);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
        position: relative;
        overflow: hidden;
        width: 768px;
        max-width: 100%;
        min-height: 480px;
    }

    .container p {
        font-size: 14px;
        line-height: 20px;
        letter-spacing: 0.3px;
        margin: 20px 0;
    }

    .container span {
        font-size: 12px;
    }

    .container h1 {
        font-weight: bold;
    }

    .container .checkbox {
        height: 10px;
        width: 10px;
    }

    .container a {
        color: #333;
        font-size: 13px;
        text-decoration: none;
        margin: 15px 0 10px;
    }

    .container button {
        background-color: #008b8b;
        color: #fff;
        font-size: 12px;
        padding: 10px 45px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-top: 10px;
        cursor: pointer;
    }

    .container button.hidden {
        background-color: transparent;
        border-color: #fff;
    }

    .container form {
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 40px;
        height: 100%;
    }

    .container input {
        background-color: #eee;
        border: none;
        margin: 8px 0;
        padding: 10px 15px;
        font-size: 13px;
        border-radius: 8px;
        width: 100%;
        outline: none;
    }

    .form-container {
        position: absolute;
        top: 0;
        height: 100%;
        transition: all 0.6s ease-in-out;
    }

    .sign-in {
        left: 0;
        width: 50%;
        z-index: 2;
    }

    .container.active .sign-in {
        transform: translateX(100%);
    }

    .sign-up {
        left: 0;
        width: 50%;
        opacity: 0;
        z-index: 1;
    }

    .container.active .sign-up {
        transform: translateX(100%);
        opacity: 1;
        z-index: 5;
        animation: move 0.6s;
    }

    @keyframes move {

        0%,
        49.99% {
            opacity: 0;
            z-index: 1;
        }

        50%,
        100% {
            opacity: 1;
            z-index: 5;
        }
    }

    .social-icons {
        margin: 20px 0;
    }

    .social-icons a {
        border: 1px solid #ccc;
        border-radius: 20%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 0 3px;
        width: 40px;
        height: 40px;
    }

    .toggle-container {
        position: absolute;
        top: 0;
        left: 50%;
        width: 50%;
        height: 100%;
        overflow: hidden;
        transition: all 0.6s ease-in-out;
        border-radius: 150px 0 0 100px;
        z-index: 1000;
    }

    .container.active .toggle-container {
        transform: translateX(-100%);
        border-radius: 0 150px 100px 0;
    }

    .toggle {
        background-color: #008b8b;
        height: 100%;
        background: linear-gradient(to right, #008b56, #008b8b);
        color: #fff;
        position: relative;
        left: -100%;
        height: 100%;
        width: 200%;
        transform: translateX(0);
        transition: all 0.6s ease-in-out;
    }

    .container.active .toggle {
        transform: translateX(50%);
    }

    .toggle-panel {
        position: absolute;
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 0 30px;
        text-align: center;
        top: 0;
        transform: translateX(0);
        transition: all 0.6s ease-in-out;
    }

    .toggle-left {
        transform: translateX(-200%);
    }

    .container.active .toggle-left {
        transform: translateX(0);
    }

    .toggle-right {
        right: 0;
        transform: translateX(0);
    }

    .container.active .toggle-right {
        transform: translateX(200%);
    }

    .container .btn-link {
        color: #008b8b;
        text-decoration: none;
    }

    .buton:hover {
        background-color: #007c7c;
        border-color: #007c7c;

    }


    .container .btn-link:focus {
        outline: none;
        box-shadow: none;
    }

    .container .btn-link:active {
        color: #007c7c;
    }




    /* button styles */

    .button {
        left: 10px;
        top: 5px;
        margin: 10px;
        position: fixed;
        text-decoration: none;
        line-height: 1;
        border-radius: 1.5rem;
        overflow: hidden;

        background-color: transparent;
        border: none;
        cursor: pointer;

    }

    .button-decor {
        position: absolute;
        inset: 0;
        background-color: var(--clr);
        -webkit-transform: translateX(-100%);
        -ms-transform: translateX(-100%);
        transform: translateX(-100%);
        -webkit-transition: -webkit-transform .6s;
        transition: -webkit-transform .6s;
        transition: transform .6s;
        transition: transform .6s, -webkit-transform .6s;
        z-index: 0;

    }

    .button-content {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .button__icon {
        width: 48px;
        height: 40px;
        background-color: var(--clr);
        display: grid;
        place-items: center;
        border-radius: 1.5rem;
    }

    .button__text {
        display: inline-block;
        -webkit-transition: .6s;
        color: transparent;
        transition: .6s;
        padding: 1px 1.5rem 1px;
        padding-left: 1px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .button:hover .button__text {
        color: #fff;
    }

    .button:hover .button-decor {

        -webkit-transform: translate(0);
        -ms-transform: translate(0);
        transform: translate(0);

    }


    .svg-fill-primary {
        fill: #FFF;
    }

    .svg-fill-secondary {
        fill: transparent;
    }

    .svg-fill-tertiary {
        fill: transparent;
    }

    .svg-stroke-primary {
        stroke: #FFF;
    }
</style>
@endsection