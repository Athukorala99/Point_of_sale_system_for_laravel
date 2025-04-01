@extends('layouts.app')


@section('content')

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-15">
                <div class="card">

                    <div class="card-body">

                        <div class="cardBox">

                            <div class="card">
                                <div class="heading">Delete Order</div>
                                <form action="{{route('deleteorder')}}" method="post">
                                    @csrf
                                    @method('get')
                                    <div class="form-group">
                                        <label for="name" class="sdatelbl">Start Date</label>
                                        <label for="name" class="edatelbl">End Date</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="sdate" class="form-control" id="sdate" required>
                                        <input type="date" name="edate" class="form-control" id="edate" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-warning" type="reset">Clear</button> &nbsp;
                                        <button class="btn btn-info" type="submit"> View</button>
                                    </div>
                                </form>
                            </div>


                            <div class="card">
                                <div class="heading"> Pay In Out</div>
                                <form action="{{route('payinoutreport')}}" method="post">
                                    @csrf
                                    @method('get')
                                    <div class="form-group">
                                        <label for="name" class="sdatelbl">Start Date</label>
                                        <label for="name" class="edatelbl">End Date</label>

                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="sdate" class="form-control" id="sdate" required>
                                        <input type="date" name="edate" class="form-control" id="edate" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-warning" type="reset">Clear</button> &nbsp;
                                        <button class="btn btn-info" type="submit"> View</button>
                                    </div>
                                </form>
                            </div>


                            <div class="card">
                                <div class="heading">Day Profit Report</div>
                                <form action="{{route('dayprofit')}}" method="post">
                                    @csrf
                                    @method('get')
                                    <div class="form-group">
                                        <label for="name" class="sdatelbl">Start Date</label>
                                        <label for="name" class="edatelbl">End Date</label>

                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="sdate" class="form-control" id="sdate" required>
                                        <input type="date" name="edate" class="form-control" id="edate" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-warning" type="reset">Clear</button> &nbsp;
                                        <button class="btn btn-info" type="submit"> View</button>
                                    </div>
                                </form>
                            </div>


                            <div class="card">
                                <div class="heading"> User Profit Report</div>
                                <form action="{{route('userprofit')}}" method="post">
                                    @csrf
                                    @method('get')
                                    <div class="form-group">
                                        <label for="name" class="sdatelbl">Start Date</label>
                                        <label for="name" class="edatelbl">End Date</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="sdate" class="form-control" id="sdate" required>
                                        <input type="date" name="edate" class="form-control" id="edate" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-warning" type="reset">Clear</button> &nbsp;
                                        <button class="btn btn-info" type="submit"> View</button>
                                    </div>
                                </form>
                            </div>


                            <div class="card">
                                <div class="heading"> Products Quantity Report</div>
                                <form action="{{route('productquantity')}}" method="post">
                                    @csrf
                                    @method('get')
                                    
                                    <div class="modal-footer">
                                        <button class="btn btn-info" type="submit"> View</button>
                                    </div>
                                </form>
                            </div>

                            <div class="card">
                                <div class="heading"> GRN Report</div>
                                <form action="{{route('GRNReportView')}}" method="post">
                                    @csrf
                                    @method('get')
                                    <div class="form-group">
                                        <label for="name" class="sdatelbl">Start Date</label>
                                        <label for="name" class="edatelbl">End Date</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="sdate" class="form-control" id="sdate" required>
                                        <input type="date" name="edate" class="form-control" id="edate" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-warning" type="reset">Clear</button> &nbsp;
                                        <button class="btn btn-info" type="submit"> View</button>
                                    </div>
                                </form>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





    <style>
        :root {
            --green: #008B8B;
            --white: #fff;
            --gray: #f5f5f5;
            --black1: #222;
            --black2: #999;
        }

        /* //////////////////////card///////////// */
        .cardBox {            
            margin: 0 2% 0 2%;
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 30px;
        }

        .cardBox .card {            
            position: relative;
            background: var(--white);
            padding: 15px;
            border-radius: 20px;
            display: flex;
            width: 450px;
            justify-content: space-between;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        }

        .cardBox .card .heading {
            position: relative;
            font-weight: 500;
            font-size: 1.5rem;
            color: var(--green);
        }


        .form-group {
            display: flex;
            margin-bottom: auto;
            /* align-items: center;                Align labels vertically if needed */
            justify-content: space-between;
            /* Space them evenly or adjust as needed */
        }

        #sdate,
        #edate {
            width: 200px;
            cursor: pointer;
        }

        .sdatelbl,
        .edatelbl {
            margin-left: 15%;
            margin-right: 10px;
            /* Add spacing between the labels */
            flex: 1;
            /* Optional: Ensures both labels take equal space */
        }

        .modal-footer {
            margin-top: 8px;
            justify-content: center;
        }
    </style>
    <script>

    </script>
    @endsection