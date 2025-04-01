@extends('layouts.first')

@section('content')
<link rel="stylesheet" href="{{ asset('style.css') }}">

<div class="container">
    <div class="row justify-content-end offset-md-3">
        <div class="col-md-8">
            <div class="card1">
                <!-- <div class="card-header">{{ __('Register') }}</div> -->

                <div class="card-body">
                    <div class="label-container">
                        <label for="text">Register</label>
                        <hr style="border-top: 3px solid;">
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-2 mx-auto text">
                            <!-- <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label> -->

                            <div class="col-md-6 offset-md-2">
                                <label for="name" class=" col-form-label text-md-end">{{ __('Name') }}</label>
                                <input id="name" placeholder="Your Name" type="text" class="form-control @error('name') is-invalid @enderror size" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2 mx-auto text">
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> -->

                            <div class="col-md-6 offset-md-2">
                                <label for="email" class=" col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <input id="email" placeholder="example**@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror size" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2 mx-auto text">
                            <!-- <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label> -->

                            <div class="col-md-6 offset-md-2">
                                <label for="phone" class=" col-form-label text-md-end">{{ __('Phone') }}</label>
                                <input id="phone" placeholder="07******" type="text" class="form-control @error('phone') is-invalid @enderror size" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2 mx-auto text">
                            <!-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> -->

                            <div class="col-md-6 offset-md-2">
                                <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                                <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror size" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4 mx-auto text">
                            <!-- <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label> -->

                            <div class="col-md-6 offset-md-2">
                                <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" placeholder="Re-Enter Password" type="password" class="form-control size" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3 mx-auto text">
                            <div class="col-md-6 offset-md-2 register-button">
                                <button type="submit" class="btn btn-primary size">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection