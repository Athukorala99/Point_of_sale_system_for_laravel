@extends('layouts.app')

@section('content')

<div class="profile-container">

    <div class="profile-card">
        <div class="profile-header">
            <img src="{{ asset('images/profile.jpg') }}" alt="User Avatar" class="profile-avatar"><br><br>
            <h2><b>{{ auth()->user()->name }}</b></h2>
            <!-- <p class="profile-bio">A passionate web developer who loves to create beautiful websites.</p> -->
        </div>
        <div class="profile-details">
            <ul>
                <!-- <li><strong>Name : </strong><label for="name"> {{ auth()->user()->name }}</label> </li> -->
                <li><strong>Email : </strong> {{ auth()->user()->email }}</li>
                <li><strong>Contact Number : </strong> {{ auth()->user()->contact }} </li>
                <li><strong>Member Since : </strong> {{ auth()->user()->created_at->format('d,M,Y') }}</li>

            </ul>
        </div>
        <div class="profile-actions">
            <a href="{{ route('changepassword') }}" style="text-decoration: none;">
                <button type="button" class="btn btn-warning">Change Password</button>
            </a>
            
            @auth

            @if (auth()->user()->id == 1)
            
            <a href="{{route('company.index')}}" style="text-decoration: none;">
            <!-- data-toggle="modal" data-target="#"  -->
                    <button type="button" class="btn btn-warning">Company Details</button>
                </a>
                @else
                @endif

            @if (auth()->user()->is_admin == 0)
            <a href="{{ url('cashire/home') }}">
                <button type="button" class="btn btn-primary backbtn">Home</button>
            </a>
            @else
            <br><br>
            <a href="{{ url('home') }}">
                <button type="button" class="btn btn-primary backbtn">Home</button>
            </a>
            @endif


            
                @endauth

        </div>
    </div>
</div>



@endsection

<!-- <script>
    function reloadprofile() {
        location.reload();
    }
</script> -->

<style>
    .profile-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        max-height: 100vh;
        margin-top: 90px;

    }

    .profile-card {
        background-color: #fff;
        width: 350px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        text-align: center;

    }

    .profile-header {
        margin-bottom: 20px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #3498db;

        box-shadow: 0 0 20px rgba(52, 152, 219, 1),
            /* Strong glow */
            0 0 30px rgba(52, 152, 219, 0.7);
        /* Secondary glow */
        transition: box-shadow 0.3s ease;

    }

    h2 {
        font-size: 24px;
        margin: 10px 0;
        color: #333;
    }

    .profile-bio {
        color: #777;
        font-size: 14px;
    }

    .profile-details ul {
        list-style: none;
        margin-bottom: 20px;
        color: #333;
    }

    .profile-details li {
        font-size: 16px;
        margin: 10px 0;
    }

    .backbtn {
        width: 100px;
        color: #fff;
        text-decoration: none;
    }
</style>