<div class="container">

    <h2><b>Company Details</b></h2>



    <form action="{{ route('company.update',1) }}" method="POST" enctype="multipart/form-data">


        @if (session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @elseif(session()->has('info'))
        <div class="alert alert-info">{{session('info')}}</div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name"> Company Name </label>
            <input type="text" name="name" id="name" value="{{$companies[0]->company_name}}">
        </div>

        <div class="form-group">
            <label for="address"> Address </label>
            <input type="text" name="address" id="address" value="{{$companies[0]->company_address}}">
        </div>

        <div class="form-group">
            <label for="email"> Email </label>
            <input type="email" name="email" id="email" value="{{$companies[0]->company_email}}">
        </div>

        <div class="form-group">
            <label for="phone"> Phone </label>
            <input type="tel" name="phone" id="phone" value="{{$companies[0]->company_phone}}">
        </div>

        <div class="form-group">
            <label for="logo">Company Logo</label>
            <!-- <input type="file" name="logo" id="logo" accept="image/*"> -->
            <input type="file" name="company_logo" id="company_logo" accept="image/*">

        </div>

        <div class="form-group">
            <button type="submit"> Update</button>

            <a href="{{ route('profile.index') }}">
                <button type="button"> Cancel</button>
            </a>

        </div>

    </form>

</div>

<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-info {
        background-color: #cce5ff;
        color: #004085;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background-color: #f0f4f8;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
        text-shadow: 0 0 5px rgba(173, 216, 230, 0.5), 0 0 10px rgba(173, 216, 230, 0.7);
    }

    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 14px;
        margin-bottom: 8px;
        color: #666;
    }

    input {
        padding: 5px 15px 5px 10px;
        font-size: 15px;
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    input:focus {
        border-color: #3498db;
        outline: none;
    }

    input[type="file"] {
        padding: 0;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #3498db;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-bottom: 10px;
    }

    button:hover {
        background-color: #2980b9;
    }

    .form-group button:last-child {
        background-color: #e74c3c;
    }

    .form-group button:last-child:hover {
        background-color: #c0392b;
    }
</style>