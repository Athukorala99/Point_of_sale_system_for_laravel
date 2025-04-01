@extends('layouts.cashire')



@section('content')

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-12">
      <div class="card">
        <h4 class="card-header" style="background: #008B8B; color:#fff">
          <marquee behavior="" direction="">Welcome Company Pos Management System {{auth()->user()->name}}</marquee>
        </h4>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <!-- ========================= Main ==================== -->
          <div class="main">
            <a href=""></a>
            <div class="button-group">
              <a href="#" data-toggle="modal" data-target="#payout{{auth()->user()->id}}" class="btn btn-custom btn-primary payout" id="payout" style="border-color: #008b8b;"><i class="fa fa-undo"></i>Pay Out</a>&nbsp; &nbsp;
              <a href="{{route('payinout.show', auth()->user()->id)}}" class="btn btn-custom mony_hand" id="mony_hand"><i class="fa fa-arrow-down"></i>Insert Money</a>
              <button type="button" class="btn btn-custom reportbtn " id="reportbtn" onclick="PrintReceptContent('dailyReport')"><i class="fa fa-print"></i>Print Daily Report</button>
            </div>
            <!-- ======================= Cards ================== -->
            <div class="cardBox">
              <div class="card">
                <div>
                  <div class="numbers">Rs.{{auth()->user()->cash + auth()->user()->card + auth()->user()->bank + auth()->user()->consumer_credit}}</div>
                  <div class="cardName">Earning</div>
                </div>

                <div class="iconBx">
                  <ion-icon name="eye-outline"></ion-icon>
                </div>
              </div>

              <div class="card">
                <div>
                  <div class="numbers">Rs.{{$cash=auth()->user()->cash}}</div>
                  <div class="cardName">Cash Credit</div>
                </div>

                <div class="iconBx">
                  <ion-icon name="cart-outline"></ion-icon>
                </div>
              </div>

              <div class="card">
                <div>
                  <div class="numbers">Rs.{{$card=auth()->user()->card}}</div>
                  <div class="cardName">Credit/Debit Payament</div>
                </div>

                <div class="iconBx">
                  <ion-icon name="chatbubbles-outline"></ion-icon>
                </div>
              </div>

              <div class="card">
                <div>
                  <div class="numbers">Rs.{{$bank=auth()->user()->bank}}</div>
                  <div class="cardName">Bank Transfer</div>
                </div>

                <div class="iconBx">
                  <ion-icon name="cash-outline"></ion-icon>
                </div>
              </div>
              <div class="card">
                <div>
                  <div class="numbers">Rs.{{$consumer_credit=auth()->user()->consumer_credit}}</div>
                  <div class="cardName">consumer Credit</div>
                </div>

                <div class="iconBx">
                  <ion-icon name="eye-outline"></ion-icon>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
    <div class="modal">
      <div id="dailyReport">
        @include('printReport.DailyReport')
      </div>
    </div>
    <div class="modal right fade" id="payout{{auth()->user()->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="staticBackdropLabel">Pay Out User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('payout.edit',auth()->user()->id)}}" method="post">
              @csrf
              @method('get')
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control" id="name" placeholder="Enter Name" readonly>
              </div>
              <div class="form-group">
                <label for="name">Pay out</label>
                <input type="number" name="Payoutcash" class="form-control" id="cash" placeholder="Enter Amount" step="0.01">
              </div>
              <div class="form-group">
                <label for="name">Discription</label>
                <input type="text" name="discription" class="form-control" id="name" placeholder="Enter Name">
              </div>
              <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-success" type="submit">Pay out</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <style>
      /* =========== Google Fonts ============ */
      @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

      /* =============== Globals ============== */
      * {
        font-family: "Ubuntu", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      :root {
        --blue: #008B8B;
        --white: #fff;
        --gray: #f5f5f5;
        --black1: #222;
        --black2: #999;
      }

      body {
        min-height: 100vh;
        overflow-x: hidden;
      }

      .container {
        position: relative;
        width: 100%;
      }

      /* =============== Navigation ================ */


      /* ===================== Main ===================== */
      .main {
        padding: absolute;
        margin-left: 10%;
        width: calc(100% - 300px);
        left: 300px;
        min-height: 100vh;
        background: var(--white);
        transition: 0.5s;
      }

      .main.active {
        width: calc(100% - 80px);
        left: 80px;
      }

      .topbar {
        width: 100%;
        height: 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
      }

      .toggle {
        position: relative;
        width: 60px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2.5rem;
        cursor: pointer;
      }

      .search {
        position: relative;
        width: 400px;
        margin: 0 10px;
      }

      .search label {
        position: relative;
        width: 100%;
      }

      .search label input {
        width: 100%;
        height: 40px;
        border-radius: 40px;
        padding: 5px 20px;
        padding-left: 50px;
        font-size: 18px;
        outline: none;
        border: 1px solid var(--black2);
      }

      .search label ion-icon {
        position: absolute;
        top: 0.70rem;
        left: 20px;
        font-size: 1.2rem;
      }

      .user {
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
      }

      .user img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      /* ======================= Cards ====================== */
      .cardBox {
        position: relative;
        width: 100%;

        padding: 70px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 40px;
      }

      .cardBox .card {
        position: relative;
        background: var(--white);
        padding: 30px;
        border-radius: 20px;
        display: flex;
        justify-content: space-between;
        cursor: pointer;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
      }

      .cardBox .card .numbers {
        position: relative;
        font-weight: 500;
        font-size: 1.5rem;
        color: var(--blue);
      }

      .cardBox .card .cardName {
        color: var(--black2);
        font-size: 1.1rem;
        margin-top: 5px;
      }

      .cardBox .card .iconBx {
        font-size: 1.5rem;
        color: var(--black2);
      }

      .cardBox .card:hover {
        background: var(--blue);
        transform: scale(108%);
        transition: 0.5s background-color linear;
      }

      .cardBox .card:hover .numbers,
      .cardBox .card:hover .cardName,
      .cardBox .card:hover .iconBx {
        color: var(--white);
      }

      /* ================== Order Details List ============== */
      .details {
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-gap: 30px;
        /* margin-top: 10px; */
      }

      .details .recentOrders {
        position: relative;
        display: grid;
        min-height: 500px;
        background: var(--white);
        padding: 20px;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        border-radius: 20px;
      }

      .details .cardHeader {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
      }

      .cardHeader h2 {
        font-weight: 600;
        color: var(--blue);
      }

      .cardHeader .btn {
        position: relative;
        padding: 5px 10px;
        background: var(--blue);
        text-decoration: none;
        color: var(--white);
        border-radius: 6px;
      }

      .details table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
      }

      .details table thead td {
        font-weight: 600;
      }

      .details .recentOrders table tr {
        color: var(--black1);
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
      }

      .details .recentOrders table tr:last-child {
        border-bottom: none;
      }

      .details .recentOrders table tbody tr:hover {
        background: var(--blue);
        color: var(--white);
      }

      .details .recentOrders table tr td {
        padding: 10px;
      }

      .details .recentOrders table tr td:last-child {
        text-align: end;
      }

      .details .recentOrders table tr td:nth-child(2) {
        text-align: end;
      }

      .details .recentOrders table tr td:nth-child(3) {
        text-align: center;
      }

      .status.delivered {
        padding: 2px 4px;
        background: #8de02c;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
      }

      .status.pending {
        padding: 2px 4px;
        background: #e9b10a;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
      }

      .status.return {
        padding: 2px 4px;
        background: #f00;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
      }

      .status.inProgress {
        padding: 2px 4px;
        background: #1795ce;
        color: var(--white);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
      }

      .recentCustomers {
        position: relative;
        display: grid;
        min-height: 500px;
        padding: 20px;
        background: var(--white);
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        border-radius: 20px;
      }

      .recentCustomers .imgBx {
        position: relative;
        width: 40px;
        height: 40px;
        border-radius: 50px;
        overflow: hidden;
      }

      .recentCustomers .imgBx img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .recentCustomers table tr td {
        padding: 12px 10px;
      }

      .recentCustomers table tr td h4 {
        font-size: 16px;
        font-weight: 500;
        line-height: 1.2rem;
      }

      .recentCustomers table tr td h4 span {
        font-size: 14px;
        color: var(--black2);
      }

      .recentCustomers table tr:hover {
        background: var(--blue);
        color: var(--white);
      }

      .recentCustomers table tr:hover td h4 span {
        color: var(--white);
      }

      /* ====================== Responsive Design ========================== */
      @media (max-width: 991px) {
        .navigation {
          left: -300px;
        }

        .navigation.active {
          width: 300px;
          left: 0;
        }

        .main {
          width: 100%;
          left: 0;
        }

        .main.active {
          left: 300px;
        }

        .cardBox {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (max-width: 768px) {
        .details {
          grid-template-columns: 1fr;
        }

        .recentOrders {
          overflow-x: auto;
        }

        .status.inProgress {
          white-space: nowrap;
        }
      }

      @media (max-width: 480px) {
        .cardBox {
          grid-template-columns: repeat(1, 1fr);
        }

        .cardHeader h2 {
          font-size: 20px;
        }

        .user {
          min-width: 40px;
        }

        .navigation {
          width: 100%;
          left: -100%;
          z-index: 1000;
        }

        .navigation.active {
          width: 100%;
          left: 0;
        }

        .toggle {
          z-index: 10001;
        }

        .main.active .toggle {
          color: #fff;
          position: fixed;
          right: 0;
          left: initial;
        }
      }

      /* report btn styles */
      .reportbtn {
        background-color: #008B8B;
        color: #fff;
        float: right;
        margin-right: 25px;
        margin-top: 10px;
        outline-color: #008B8B;
        text-decoration: none;
      }


      .reportbtn:active,
      .reportbtn:hover {
        background-color: #007878;
        color: #fff;
        text-decoration: none;

      }

      .mony_hand {
        background-color: #008B8B;
        color: #fff;
        float: right;
        margin-right: 25px;
        margin-top: 10px;
        outline-color: #008B8B;
        text-decoration: none;
      }


      .mony_hand:active,
      .mony_hand:hover {
        background-color: #007878;
        color: #fff;
        text-decoration: none;
      }

      .payout {
        background-color: #008B8B;
        color: #fff;
        float: right;
        margin-right: 25px;
        margin-top: 10px;
        outline-color: #008B8B;
        text-decoration: none;
      }


      .payout:active,
      .payout:hover {
        background-color: #007878;
        color: #fff;
        text-decoration: none;
      }
    </style>
    <script>
      if ('{{auth()->user()->hand_money}}' == '0') {
        document.getElementById('reportbtn').style.display = 'none';
        var elements = document.getElementsByClassName('reportbtn');
        for (var i = 0; i < elements.length; i++) {
          elements[i].style.display = 'none';
        }
      }

      if ('{{auth()->user()->hand_money}}' == '') {
        document.getElementById('reportbtn').style.display = 'none';
        var elements = document.getElementsByClassName('reportbtn');
        for (var i = 0; i < elements.length; i++) {
          elements[i].style.display = 'none';
        }
      }
      if ('{{auth()->user()->payout}}' == '0') {
        var elements = document.getElementsByClassName('payout');
        for (var i = 0; i < elements.length; i++) {
          elements[i].style.display = 'none';
        }
      }
      // add hovered class to selected list item
      let list = document.querySelectorAll(".navigation li");

      function activeLink() {
        list.forEach((item) => {
          item.classList.remove("hovered");
        });
        this.classList.add("hovered");
      }

      list.forEach((item) => item.addEventListener("mouseover", activeLink));

      // Menu Toggle
      let toggle = document.querySelector(".toggle");
      let navigation = document.querySelector(".navigation");
      let main = document.querySelector(".main");

      toggle.onclick = function() {
        navigation.classList.toggle("active");
        main.classList.toggle("active");
      };


      //print report
      function printReport() {
        var reportwindow = window.open('/daily-report');

        reportwindow.onload = function() {
          reportwindow.print();

        };
      }


      function PrintReceptContent(el) {
        // Create the button's HTML
        var data = '<input type="button" id="printPageButton" class="printPageButton" style="@media print { .printPageButton { display: none; } };display:block; width:100%; border:none; background-color:#008B8B; color:#fff;padding:14px 28px; font-size:16px; cursor:pointer; text-align:center;" value="Print Receipt" onClick="window.print()">';

        // Add the content from the specified element
        data += document.getElementById(el).innerHTML;

        // Open a new window to print the receipt
        var myReceipt = window.open('', 'myReceipt', 'left=150,top=130,width=400,height=400');
        myReceipt.screenX = 0;
        myReceipt.screenY = 0;

        // Write the content to the new window
        myReceipt.document.write('<html><head><title>Daily Report</title>');
        myReceipt.document.write('<style>@media print { .printPageButton { display: none; } }</style>'); // Hide button during print
        myReceipt.document.write('</head><body>');
        myReceipt.document.write(data);
        myReceipt.document.write('</body></html>');

        // Focus on the new window
        myReceipt.focus();

        // Automatically close the window after printing
        setTimeout(() => {
            myReceipt.close();
        }, 8000);
    }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <!-- new card end -->
  </div>
</div>
</d>
</div>
</div>

@endsection