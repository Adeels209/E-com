@extends('User.layouts.master')


@section('content')
    <div class="breadcumb-area breadcumb-2 overlay pos-rltv">
        <div class="bread-main">
            <div class="bred-hading text-center">
                <h5>Orders</h5> </div>
            <ol class="breadcrumb">
                <li class="home"><a title="Go to Home Page" href="index.html">Home</a></li>
                <li class="active">Orders</li>
            </ol>
        </div>
    </div>
    <div class="cart-checkout-area  pt-30">
        <div class="container">
            <div class="row">
                <div class="product-area">
                    <div class="title-tab-product-category">
                        <div class="col-md-12 text-center pb-60">
                            <ul class="nav heading-style-3" role="tablist">
                                <li role="presentation" class="active shadow-box"><a href="#cart" aria-controls="cart" role="tab" data-toggle="tab"><span></span> Orders</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- cart are start-->

                    <div class="clearfix"></div>
                    <div class="col-sm-12" style="padding-bottom: 100px!important">
                        <div class="content-tab-product-category pb-70">
                          @include('user::layouts.dashboard-siderbar')
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="cart">
                                    <!-- cart are start-->
                                    <div class="cart-page-area">
                                        <div class="table-responsive mb-20">
                                            <table class="shop_table-2 cart table">
                                                <thead>
                                                <tr>
                                                    <th class="product-thumbnail ">Image</th>
                                                    <th class="product-name ">Product Name</th>
                                                    <th class="product-price ">Price</th>
                                                    <th class="product-price ">Paid </th>
                                                    <th class="product-status">Status</th>
                                                    <th class="product-order-no">Order No</th>
                                                    <th class="product-quantity">Quantity</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($order))
                                                    @foreach($order as $orders)
                                                        @foreach($orders->orderItems as $item)
                                                    <tr class="cart_item">
                                                            <td class="item-img">
                                                                <a href="#"><img style="object-fit: cover; object-position: center"  src="{{ URL::to($item->image)}}" alt=""> </a>
                                                            </td>
                                                            <td class="item-title">{{ $item->product_name }}<a href="#"></a></td>
                                                            <td class="item-price">{{ $item->selling_price }}</td>
                                                            <td class="item-price">{{ $orders->paid_price }}</td>
                                                            <td class="item-status">{{ $orders->status }}</td>
                                                            <td class="item-qty" style="width:20%;" >
                                                                <div class="cart-quantity">
                                                                    <div class="product-qty">
                                                                        <div class="cart-quantity">
                                                                            <div class="cart-plus-minus">
                                                                              #{{ $orders->order_no }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="item-status">{{ $item->quantity }}</td>
                                                    </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                            </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="pagination-btn text-center">
                                                <ul class="page-numbers">
                                                    {{ $order->render() }}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection