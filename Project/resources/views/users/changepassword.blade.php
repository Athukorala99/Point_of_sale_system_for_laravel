@extends('layouts.app')

@section('content')

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->

<div class="password-container">
    <div class="change-password-container">
        <h2><b>Change Password</b></h2>
        <hr>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <div class="ff">
                <label for="current_password">Current Password</label>
            </div>

            <div class="form-group">
                <input name="current_password" type="password" id="password" placeholder="Password" required>
               

                @error('current_password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="ff">
                <label for="new_password">New Password</label>
            </div>
            <div class="form-group">

                <input type="password" id="new_password" name="new_password"  required>

                 <!-- <span class="toggle-password">
                    <i id="eye-icon" class="fa fa-eye eye" aria-hidden="true"></i>
                </span> -->
                
                @error('new_password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="ff">
                <label for="new_password_confirmation">Confirm New Password</label>
            </div>
            <div class="form-group">

                <input type="password" id="new_password_confirmation" name="new_password_confirmation"  required>
                
                @error('new_password_confirmation')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning backbtn">Save</button>

            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('profile.index') }}">
                <button type="button" class="btn btn-primary backbtn">Back</button>
            </a>


        </form>
    </div>
</div>
@endsection



<style>
    .password-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        max-height: 100vh;
        margin-top: 70px;
    }

    .change-password-container {
        background-color: #fff;
        width: 350px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
        text-shadow: 0 0 5px rgba(173, 216, 230, 0.5), 0 0 10px rgba(173, 216, 230, 0.7);
    }


    .form-group {
        margin-bottom: 15px;
        text-align: left;
        position: relative;
    }
    .ff{
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 1px;
        color: #555;
    }

    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    input[type="password"]:focus {
        border-color: #007BFF;
        outline: none;
    }
    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus {
        border-color: #007BFF;
        outline: none;
    }

    .error {
        color: red;
        font-size: 0.875em;
        margin-top: 5px;
    }

    .submit-button {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 100%;
    }

    .submit-button:hover {
        background-color: #0056b3;
    }

    .submit-button:active {
        background-color: #004494;
    }

    .back-button {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        background-color: #f0f0f0;
        color: #333;
        padding: 10px 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: background-color 0.3s, border-color 0.3s;
        text-align: center;
        width: 100%;
    }

    .back-button:hover {
        background-color: #e0e0e0;
    }

    .back-button:active {
        background-color: #d0d0d0;
    }

    .backbtn {
        width: 100px;
        color: #fff;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 15px;
        cursor: pointer;
    }
    .eye {
        color: #259;
    }
    .fa-eye-slash{
        color: #555;
    }


</style>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    });
</script> -->