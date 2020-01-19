@extends('User.layouts.master')


@section('content')
    <div class="breadcumb-area overlay pos-rltv">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Cart Details</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">Cart</li>
            </ol>
        </div>
    </div>
    <!--breadcumb area end -->

    <!--cart-checkout-area start -->
    <div class="cart-checkout-area  pt-30">
        <div class="container">
            <div class="row">
                <div class="product-area">
                    <div class="title-tab-product-category">
                        <div class="col-md-12 text-center pb-60">
                            <ul class="nav heading-style-3" role="tablist">
                                <li role="presentation" class="active shadow-box"><a href="#checkout" aria-controls="checkout" role="tab" data-toggle="tab"><span></span>Place Order</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div role="tabpanel" class="tab-pane  fade in" id="complete-order">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="checkout-payment-area">
                                    <div class="checkout-total mt20">
                                        <h3>Your order</h3>
                                        <form action="#" method="post">
                                            <div class="table-responsive">
                                                <table class="checkout-area table">
                                                    <thead>
                                                    <tr class="cart_item check-heading">
                                                        <td class="ctg-type"> Product</td>
                                                        <td class="cgt-des"> Price </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($cart_products as $cartProducts)

                                                    <tr class="cart_item check-item prd-name">
                                                        <td class="ctg-type"> {{ $cartProducts->product->name }} × {{ $cartProducts->quantity }} <span></span></td>
                                                        <td class="cgt-des"> RS {{ $cartProducts->product->selling_price }} </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="cart_item">
                                                        <td class="ctg-type">Shipping</td>
                                                        <td class="cgt-des ship-opt">
                                                            <div class="shipp">

                                                                <label for="pay-toggle">Shipping Price <span>RS 300</span></label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="cart_item">
                                                        <td class="ctg-type crt-total">Total</td>
                                                        <td class="cgt-des prc-total">
                                                            @if(session()->has('coupon'))
                                                                    RS {{  $totals }}
                                                                @else
                                                                    RS {{ $total }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xs-12 offset-md-4 ml-11" style="margin-top: 60px!important;width: 100%!important;padding: 20px;box-shadow: 0 0 20px #ddd;margin-bottom: 10px; border-radius: 13px">
                                        <div class="card ">
                                            <div class="card-header">
                                                <div class="row">
                                                    <h3 style="display: flex; flex-direction: row; justify-content: center; text-align: center; padding:20px " class="text-xs-center">Payment Details</h3>
                                                    <hr>
                                                    <img style="padding: 20px;" class="img-fluid cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                                                </div>
                                            </div>
                                            <div class="card-block" style="padding:20px">

                                                <form accept-charset="UTF-8" action="{{ route('place.order') }}"  class="require-validation payment-form" data-cc-on-file="false" data-stripe-publishable-key="pk_test_Oz6i6uUaVSEZ1fvvddgUzRE900O8xe5eLy" id="payment-form" method="post">
                                                    @csrf
                                                    <div class='form-row'>
                                                        <div class='col-xs-12 form-group required'>
                                                            <label class='control-label'>Name on Card</label>
                                                            <div class="input-group">
                                                                <input class='form-control' size='4' type='text' name="name">                                                                <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='form-row'>
                                                        <div class='col-xs-12 form-group  required'>
                                                            <label class='control-label'>Card Number</label>
                                                            <input autocomplete='off' name="number" class='form-control card-number' size='20' type='text'>

                                                        </div>
                                                    </div>
                                                    <div class='form-row'>
                                                        <div class='col-xs-4 form-group cvc required'>
                                                            <label class='control-label'>CVC</label>
                                                            <input name="cvc" autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                                        </div>
                                                        <div class='col-xs-4 form-group expiration required'>
                                                            <label class='control-label'>Expiration</label>
                                                            <input name="expire" class='form-control card-expiry-month' placeholder='MM' size='2' type='number'>
                                                        </div>
                                                        <div class='col-xs-4 form-group expiration required'>
                                                            <label class='control-label'>Year</label>
                                                            <input name="year" class='form-control card-expiry-year' placeholder='YYYY' size='4' type='number'>
                                                        </div>
                                                    </div>
                                                    <div class='form-row'>
                                                        <div class='col-md-12 form-group'>
                                                            <button class='form-control btn btn-primary submit-button' type='submit'>Pay</button>
                                                        </div>
                                                    </div>
                                                    <div class='form-row'>
                                                        <div class='col-md-12 error form-group hide'>
                                                            <div class='alert-danger alert'>
                                                                Please correct the errors and try again.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
                                        <input type='hidden' name='sid' value='901405536' >
                                        <input type='hidden' name='mode' value='2CO' >
                                        <input type='hidden' name='li_0_price' value='{{ $total }}' >
                                        <input type='hidden' name='street_address' value='{{ $address }}'>
                                        <input type='hidden' name='ship_street_address2' value='{{ $apartment_address }}' >
                                        <input type='hidden' name='city' value='{{ $city }}' >
                                        <input type='hidden' name='zip' value='{{ $zipcode }}' >
                                        <input type='hidden' name='email' value='{{ $email }}' >
                                        <input type='hidden' name='phone' value='{{ $phonenumber }}' >
                                        <input name='submit' type='submit' class="checkbtn" value='Checkout' style="display: none" >
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('extra_js')
    <script>
        $(document).ready(function(){
            var $myForm = $(".payment-form");
            $myForm.submit(function(){
                $myForm.submit(function(){
                    return false;
                });
            });
        });
    </script>
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
    <script>

        $(function () {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    $('button').attr('disabled', 'disabled');
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();

                }
            }

        });
    </script>
    @stop