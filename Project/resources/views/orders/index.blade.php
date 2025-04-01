@extends('layouts.app')
@section('content')

<div class="container">
    @livewire('order')
</div>

<!-- Modal -->
<div class="modal">
    <div id="print">
        @include('printReport.PaymentReceipt')
    </div>
</div>
<style>
    .modal.right .modal-dialog {
        /* position: absolute; */
        top: 0;
        right: 0;
        margin-right: 20vh;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }

    .radio-item input[type="radio"] {
        visibility: hidden;
        width: 20px;
        height: 20px;
        margin: 0 5px 0 5px;
        padding: 0;
        cursor: pointer;
    }

    /* before style */
    .radio-item input[type="radio"]:before {
        position: relative;
        margin: 4px -25px -4px 0;
        display: inline-block;
        visibility: visible;
        width: 20px;
        height: 20px;
        border-radius: 10px;
        border: 2px inset rgb(150, 150, 150, 0.75);
        background: radial-gradient(ellipse at top left, rgb(255, 255, 255) 0%, rgb(250, 250, 250)5%, rgb(230, 230, 230)95%,
                rgb(225, 225, 225)100%);
        content: '';
        cursor: pointer;
    }

    /* after style*/
    .radio-item input[type="radio"]:checked:after {
        position: relative;
        top: 0;
        left: 9px;
        display: inline-block;
        border-radius: 6px;
        visibility: visible;
        width: 12px;
        height: 12px;
        border-radius: 10px;
        border: 2px inset rgb(150, 150, 150, 0.75);
        background: radial-gradient(ellipse at top left, rgb(240, 255, 220) 0%, rgb(225, 250, 100)5%,
                rgb(75, 75, 0)95%,
                rgb(25, 100, 0)100%);
        content: '';
        cursor: pointer;
    }

    /* after checked*/
    .radio-item input[type="radio"].true:checked:after {
        background: radial-gradient(ellipse at top left,
                rgb(240, 255, 220) 0%,
                rgb(225, 250, 100)5%,
                rgb(75, 75, 0)95%,
                rgb(25, 100, 0)100%);
    }

    .radio-item input[type="radio"].false:checked:after {
        background: radial-gradient(ellipse at top left,
                rgb(255, 255, 255) 0%,
                rgb(250, 250, 250)5%,
                rgb(230, 230, 230)95%,
                rgb(225, 225, 225)100%);
    }

    .radio-item lable {
        display: inline-block;
        margin: 0;
        padding: 0;
        line-height: 25px;
        height: 25px;
        cursor: pointer;
    }
</style>
@endsection
@section('scripts')

<script>
    //$(document).ready(function(){
    //  alert(1);
    //})
    $('.add_more').on('click', function() {
        var product = $('.product_id').html();
        var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
        var tr = '<tr><td class"no"">' + numberofrow + '</td>' + '<td><select class="form-control product_id" name="product_id[]">' + product + '</select></td>' +
            '<td><input type="number" name="quantity[]" class="form-control quantity"></td>' +
            '<td><input type="number" name="price[]" class="form-control price"></td>' +
            '<td><input type="number" name="discount[]" class="form-control discount"></td>' +
            '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
            '<td><a href="#" class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i></a></td>';
        $('.addMoreProduct').append(tr);

    });

    $('.addMoreProduct').delegate('.delete', 'click', function() {
        $(this).parent().parent().remove();
        TotalAmount();
    });

    function TotalAmount() {
        var total = 0;
        $('.total_amount').each(function(i, e) {
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total);
    }
    $('.addMoreProduct').delegate('.product_id', 'change', function() {
        var tr = $(this).parent().parent();
        var price = tr.find('.product_id option:selected').attr('data-price');
        tr.find('.price').val(price);
        var qty = tr.find('.quantity').val() - 0;
        var disc = tr.find('.discount').val() - 0;
        var price = tr.find('.price').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount();

    })
    $('.addMoreProduct').delegate('.quantity,.discount', 'keyup', function() {
        var tr = $(this).parent().parent();
        var qty = tr.find('.quantity').val() - 0;
        var disc = tr.find('.discount').val() - 0;
        var price = tr.find('.price').val() - 0;
        var total_amount = (qty * price) - ((qty * price * disc) / 100);
        tr.find('.total_amount').val(total_amount);
        TotalAmount();

    })

    $('#paid_amount').on('keyup', function() {
        var total = $('.total').html();
        var paid_amount = $(this).val();
        var tot = paid_amount - total;
        $('#balance').val(tot).toFixed(2);
    })

    $('.amount-input').on('keyup', function() {
        var cash = parseFloat($('#cashcb').val()) || 0; // Convert to number, default to 0 if empty
        var bank = parseFloat($('#bankcb').val()) || 0;
        var credit = parseFloat($('#creditcb').val()) || 0;
        var total1 = parseFloat($('.total').html());

        var tot1 = cash + bank + credit;
        var tot2 = tot1 - total1;

        $('#paid_amount').val(tot1.toFixed(2)); // Round the total to 2 decimal places
        $('#balance').val(tot2.toFixed(2));
    });

    $('.total').on('keyup', function() {
        var cash = parseFloat($('#cashcb').val()) || 0; // Convert to number, default to 0 if empty
        var bank = parseFloat($('#bankcb').val()) || 0;
        var credit = parseFloat($('#creditcb').val()) || 0;
        var total1 = parseFloat($('.total').html());

        var tot1 = cash + bank + credit;
        var tot2 = tot1 - total1;

        $('#paid_amount').val(tot1.toFixed(2)); // Round the total to 2 decimal places
        $('#balance').val(tot2.toFixed(2));
    });




$('.total').on('DOMSubtreeModified', function() { 
    var cash = parseFloat($('#cashcb').val()) || 0;  // Convert to number, default to 0 if empty
    var bank = parseFloat($('#bankcb').val()) || 0;
    var credit = parseFloat($('#creditcb').val()) || 0;
    var total1 = parseFloat($('.total').text()) || 0;  // Get the text content from .total element

    var totalPaid = cash + bank + credit;  // Sum of cash, bank, and credit
    var balance = totalPaid - total1;  // Calculate the balance

    $('#paid_amount').val(totalPaid.toFixed(2));  // Update the paid amount, rounded to 2 decimal places
    $('#balance').val(balance.toFixed(2));  // Update the balance, rounded to 2 decimal places
});

// Event listener for payment field changes
$('#cashcb, #bankcb, #creditcb').on('input', function() {
    $('.total').trigger('DOMSubtreeModified');
});


function PrintReceptContent(el) {
        // Get the content from the specified element
        var content = document.getElementById(el).innerHTML;

        // Open a new window to print the receipt
        var myReceipt = window.open('', 'myReceipt', 'left=150,top=130,width=400,height=400');
        myReceipt.screenX = 0;
        myReceipt.screenY = 0;

        // Write the content to the new window
        myReceipt.document.write(`
            <html>
                <head>
                    <title>Payment Receipt</title>
                    <style>
                        /* General styles for the receipt */
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                        }
                        /* Hide all buttons in the print view */
                        @media print {
                            input[type="button"] {
                                display: none;
                            }
                        }
                    </style>
                </head>
                <body>
                    ${content}
                </body>
            </html>
        `);

        // Focus on the new window
        myReceipt.document.close(); // Close the document to finish rendering
        myReceipt.focus();

        // Automatically open the print dialog
        myReceipt.print();

        // Automatically close the window after printing
        setTimeout(() => {
            myReceipt.close();
        }, 8000);
    }

</script>
@endsection