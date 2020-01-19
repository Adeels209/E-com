@extends('User.layouts.master')


@section('content')
    <div class="cart-checkout-area  pt-30">
        <div class="container">
            <div class="row">
                <div class="product-area">
                    <div class="title-tab-product-category">
                        <div class="col-md-12 text-center pb-60">
                            <ul class="nav heading-style-3" role="tablist">
                                <li role="presentation" class="active shadow-box"><a href="#cart" aria-controls="cart" role="tab" data-toggle="tab"><span></span> Order Details</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- cart are start-->

                    <div class="clearfix"></div>
                    <div class="col-sm-12" style="padding-bottom: 100px!important">
                        <div class="content-tab-product-category pb-70">
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
                                                    <th class="product-status">Status</th>
                                                    <th class="product-order-no">Order No</th>
                                                    <th class="product-quantity">Quantity</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($order))
                                                        @foreach($order->orderItems as $item)
                                                            <tr class="cart_item">
                                                                <td class="item-img">
                                                                    <a href="#"><img style="object-fit: cover; object-position: center"  src="{{ URL::to($item->product->images[0]->small_image)}}" alt=""> </a>
                                                                </td>
                                                                <td class="item-title">{{ $item->product->name }}<a href="#"></a></td>
                                                                <td class="item-price">{{ $item->product->selling_price }}</td>
                                                                <td class="item-status">{{ $order->status }}</td>
                                                                <td class="item-qty" style="width:20%;" >
                                                                    <div class="cart-quantity">
                                                                        <div class="product-qty">
                                                                            <div class="cart-quantity">
                                                                                <div class="cart-plus-minus">
                                                                                    #{{ $order->order_no }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="item-status">{{ $item->quantity }}</td>
                                                            </tr>
                                                        @endforeach
                                                @endif
                                                </tbody>
                                            </table>
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