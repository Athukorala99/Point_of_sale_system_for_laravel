@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-15">
                <div class="card">
                    <div class="card-body">
                        <div class="cardBox">


                            
                                <form data-bs-toggle="modal" data-bs-target="#deleteModal" method="get" style="height: 100%;">
                                    <div class="card">
                                        <a class="button">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            <span class="head">Delete Orders</span>
                                        </a>
                                    </div>
                                </form>
                            


                            
                                <form data-bs-toggle="modal" data-bs-target="#PayinOutModal" method="get" style="height: 100%;">
                                    <div class="card">
                                        <a class="button">
                                            <i class="fa fa-handshake" aria-hidden="true"></i>
                                            <span class="head">Pay In Out</span>
                                        </a>
                                    </div>
                                </form>
                            



                            
                                <form data-bs-toggle="modal" data-bs-target="#DayProfitModal" method="get" style="height: 100%;">
                                    <div class="card">
                                        <a class="button">
                                            <i class="fa fa-clock" aria-hidden="true"></i>
                                            <span class="head">Day Profit</span>
                                        </a>
                                    </div>
                                </form>
                            


                            <form data-bs-toggle="modal" data-bs-target="#UserProfitModal" method="get" style="height: 100%;">
                                <div class="card">
                                    <a class="button">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span class="head">User Profit</span>
                                    </a>
                                </div>
                            </form>

                            <form action="{{route('productquantity')}}" method="post" style="height: 100%;">
                                <div class="card">
                                    <a class="button" href="{{route('productquantity')}}">
                                        <i class="fa fa-box" aria-hidden="true"></i>
                                        <span class="head">Product Quantity</span>
                                    </a>
                                </div>
                            </form>

                            <form data-bs-toggle="modal" data-bs-target="#GRNreportModal" method="get" style="height: 100%;">
                                <div class="card">
                                    <a class="button">
                                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                        <span class="head">GRN Report</span>
                                    </a>
                                </div>
                            </form>
                            


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Order Report Modal -->

    <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateModalLabel">Delete Order Report</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('deleteorder')}}" method="post" style="width: 100%; max-width: 400px;">
                        @csrf
                        @method('get')
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">Start Date</label>
                            <input type="date" name="sdate" class="form-control dt" id="sdate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">End Date</label>
                            <input type="date" name="edate" class="form-control dt" id="edate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <button type="reset" class="btn btn-warning" data-bs-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-info">View</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- PayIn Out Report Modal -->
    <div class="modal fade" id="PayinOutModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateModalLabel">PayIn Out Report</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('payinoutreport')}}" method="post" style="width: 100%; max-width: 400px;">
                        @csrf
                        @method('get')
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">Start Date</label>
                            <input type="date" name="sdate" class="form-control dt" id="sdate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">End Date</label>
                            <input type="date" name="edate" class="form-control dt" id="edate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <button type="reset" class="btn btn-warning" data-bs-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-info">View</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Day Profit Modal -->
    <div class="modal fade" id="DayProfitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateModalLabel">Day Profit Report</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('dayprofit')}}" method="post" style="width: 100%; max-width: 400px;">
                        @csrf
                        @method('get')
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">Start Date</label>
                            <input type="date" name="sdate" class="form-control dt" id="sdate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">End Date</label>
                            <input type="date" name="edate" class="form-control dt" id="edate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <button type="reset" class="btn btn-warning" data-bs-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-info">View</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- User Profit Modal -->
    <div class="modal fade" id="UserProfitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateModalLabel">User Profit Report</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('userprofit')}}" method="post" style="width: 100%; max-width: 400px;">
                        @csrf
                        @method('get')
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">Start Date</label>
                            <input type="date" name="sdate" class="form-control dt" id="sdate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">End Date</label>
                            <input type="date" name="edate" class="form-control dt" id="edate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <button type="reset" class="btn btn-warning" data-bs-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-info">View</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- GRN Report Modal -->
    <div class="modal fade" id="GRNreportModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateModalLabel">GRN Report</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('GRNReportView')}}" method="post" style="width: 100%; max-width: 400px; min-width: 250px;">
                        @csrf
                        @method('get')
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">Start Date</label>
                            <input type="date" name="sdate" class="form-control dt" id="sdate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <div class="mb-3" style="width: 100%; text-align: center;">
                            <label for="name" class="form-label" style="display: block;">End Date</label>
                            <input type="date" name="edate" class="form-control dt" id="edate" required style="width: 100%; margin-bottom: 10px;">
                        </div>
                        <button type="reset" class="btn btn-warning" data-bs-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-info">View</button>
                    </form>
                </div>
            </div>
        </div>
    </div>






    <style>
        /*new modal styles*/

        .modal {
            width: fit-content;

        }

        .dt {
            width: 300px;
        }

        .card .button {
            color: #008B8B;
            font-weight: 500;
            font-size: 1.5rem;
            text-align: center;
            border: none;
            background: none;
            cursor: pointer;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            height: 100%;
            text-decoration: none;

        }

        .card .button .fa {
            font-size: 1.25rem;
            color: #008b8b
        }

        .modal .modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .modal .modal-header {
            width: 100%;
            text-align: center;
        }

        .modal .modal-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            justify-content: center;
        }

        .modal .modal-title {
            width: 100%;
            text-align: center;
        }

        .cardBox {
            display: flex;    
            justify-content: space-between;            
            gap: 18px;
            flex-wrap: wrap;         
        }

        /* end styles */

        :root {
            --green: #008B8B;
            --white: #fff;
            --gray: #f5f5f5;
            --black1: #222;
            --black2: #999;
        }

        /* //////////////////////card///////////// */


        .cardBox .card {
            position: relative;
            background: var(--white);
            padding: 15px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            align-items: center;
            height: 100%;
            width: 250px;
            cursor: pointer;
        }

        #sdate,
        #edate {
            width: 200px;
            cursor: pointer;
        }
    </style>
    <script>

    </script>
    @endsection

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (Include Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>