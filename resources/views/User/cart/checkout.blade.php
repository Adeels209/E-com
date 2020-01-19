@extends('User.layouts.master')


@section('content')
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <script>
                swal("AH OH!", "{{ $error }}", "error");
            </script>
        @endforeach
    @endif


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
                                <li role="presentation" class="active shadow-box"><a href="#checkout" aria-controls="checkout" role="tab" data-toggle="tab"><span>02</span>Checkout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="content-tab-product-category pb-70">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane  fade in active" id="checkout">
                                    <!-- Checkout are start-->
                                    <div class="checkout-area">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="panel panel-checkout">
                                                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                                    <div class="panel-body coupon-body">

                                                                        <div class="first-last-area">
                                                                            <div class="input-box mtb-20">
                                                                                <input type="text" placeholder="Coupon Code" class="info" name="code">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class=" col-xs-12">
                                                            <div class="billing-details">
                                                                <div class="contact-text right-side" style="">
                                                                    <h2>Billing Details</h2>
                                                                    <form action="{{ route('shipping.details') }}" method="POST">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box mb-20">
                                                                                    <label>First Name <em>*</em></label>
                                                                                    <input type="text" name="fname" class="info" placeholder="First Name"  value=" @if(isset($user)){{ $user->fname }}@endif">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box mb-20">
                                                                                    <label>Last Name<em>*</em></label>
                                                                                    <input type="text" name="lname" class="info" placeholder="Last Name" value=" @if(isset($user)){{ $user->lname }}@endif">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box mb-20">
                                                                                    <label>Email Address<em>*</em></label>
                                                                                    <input type="email" name="email" class="info" placeholder="Your Email" value=" @if(isset($user)){{ $user->email }}@endif">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box mb-20">
                                                                                    <label>Phone Number<em>*</em></label>
                                                                                    <input type="text" name="phone_number" class="info" placeholder="Phone Number" value=" @if(isset($user->address->phone_number)){{$user->address->phone_number}}@endif">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="input-box mb-20">
                                                                                    <label>Address <em>*</em></label>
                                                                                    <input type="text" name="address" class="info mb-10" placeholder="Street Address" value=" @if(isset($user->address->address)){{ $user->address->address }}@endif" >
                                                                                    <input type="text" name="address_apartment" class="info mt10" placeholder="Apartment, suite, unit etc. (optional)" value="@if(isset($user->address->address_appartment)){{ $user->address->address_appartment }}@endif">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="input-box mb-20">
                                                                                    <label>Town/City <em>*</em></label>
                                                                                    <input type="text" name="city" class="info" placeholder="Town/City" value=" @if(isset($user->address->city)){{ $user->address->city }}@endif">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box">
                                                                                    <label>Post Code/Zip Code<em>*</em></label>
                                                                                    <input type="text" name="zipcode" class="info" placeholder="Zip Code" value=" @if(isset($user->address->zip_code)){{ $user->address->zip_code }}@endif">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                            <div class="right-side">
                                                                                <div class="form">
                                                                                    <div class="input-box">
                                                                                        <label>Order Notes</label>
                                                                                        <textarea placeholder="Notes about your order, e.g. special notes for delivery." class="area-tex" name="user_note"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="create-acc clearfix mtb-20">
                                                                                    <div class="process-checkout-btn text-right">
                                                                                        <button type="submit" class="btn btn-primary ">Confirm Order</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Checkout are end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection