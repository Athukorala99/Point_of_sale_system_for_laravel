
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <div class="login-container">
        <h2>User Login Form</h2>
        <form class="login-form">
            <label for="username">User Name</label>
            <input type="text" id="username" placeholder="UserName / email" required>

            <label for="password">Password</label>
            <div class="password-container">
                <input type="password" id="password" placeholder="Password" required>
                <span class="toggle-password">
                    <i id="eye-icon" class="fa fa-eye" aria-hidden="true"></i>
                </span>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

@endsection

<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #add8e6; /* Light blue background */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    font-size: 24px;
}

label {
    display: block;
    margin-bottom: 5px;
    text-align: left;
    font-size: 16px;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

.password-container {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

</style>

<script>
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
</script>

