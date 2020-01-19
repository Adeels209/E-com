@extends('User.layouts.master')


@section('content')
    <div class="breadcumb-area breadcumb-2 overlay pos-rltv">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Order Number</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">Order Successful</li>
            </ol>
        </div>
    </div>

        <div class="checkout-area-wrapper mt-120 mt-md-80 mt-sm-60 mb-120 mb-md-80 mb-sm-60">
            <div class="success-page">
                <h2 style="margin-left:280px"> Thank You, Your Order Has been Placed Successfully :) !</h2>
                <h1 class="text-center">Order #{{ $order->order_no }}</h1>
                <p class="text-center">In case of any issue our customer serve is available for you</p>
            </div>
        </div>


@endsection