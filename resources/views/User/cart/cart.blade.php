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
                                <li role="presentation" class="active shadow-box"><a href="#cart" aria-controls="cart" role="tab" data-toggle="tab"><span></span> Shopping cart</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="content-tab-product-category pb-70">
                            <!-- Tab panes -->
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
                                                        <th class="product-price ">Unit Price</th>
                                                        <th class="product-quantity">Quantity</th>
                                                        <th class="product-remove">Remove</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($cartProducts))
                                                    @foreach($cartProducts as $cart_item)
                                                    <tr class="cart_item">
                                                        <td class="item-img">
                                                            <a href="#"><img style="object-fit: contain; object-position: center" src="{{ URL::to($cart_item->images[0]->small_image)}}" alt=""> </a>
                                                        </td>
                                                        <td class="item-title">{{ $cart_item->name }} <a href="#"></a></td>
                                                        <td class="item-price"> RS {{ $cart_item->selling_price }} </td>
                                                        <td class="item-qty">
                                                            <div class="cart-quantity">
                                                                <div class="product-qty">
                                                                    <div class="cart-quantity">
                                                                        <div class="cart-plus-minus" data-id="{{ $cart_item->cart_id }}">
                                                                            <div class="dec qtybutton" onclick="decreaseQuantity({{$cart_item->cart_id}})">-</div>
                                                                                 <input style=" -moz-appearance: textfield;" value="{{ $cart_item->quantity }}" disabled="" name="qtybutton" class="cart-plus-minus-box" data-id="{{$cart_item->cart_id}}" min="1" max="{{ $cart_item->stock->quantity }}" type="number">
                                                                            <div class="inc qtybutton" onclick="increaseQuantity({{ $cart_item->cart_id }})">+</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="remove-item">
                                                            <form action="{{ route('remove.from.cart.incart', $cart_item->cart_id) }}" method="POST">@csrf<button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></form></td>
                                                    </tr>
                                                    @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>


                                            <div class="cart-bottom-area">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-7 col-xs-12">
                                                        <div class="update-coupne-area">
                                                            <div class="coupn-area">
                                                                <div class="catagory-title cat-tit-5 mb-20">
                                                                    <h3>Coupon</h3>
                                                                    <p>Enter your coupon code if you have one.</p>
                                                                </div>
                                                                <div class="input-box input-box-2 mb-20">
                                                                    <input type="text" placeholder="Coupon" id="coupon" class="info" name="subject">
                                                                </div>
                                                                <a  class="btn-def btn2" onclick="checkCoupon()">Apply Coupn</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-5 col-xs-12">
                                                        <div class="cart-total-area">
                                                            <div class="catagory-title cat-tit-5 mb-20 text-right">
                                                                <h3>Cart Totals</h3>
                                                            </div>
                                                            <div class="sub-shipping">
                                                                <p>Shipping <span>RS 300</span></p>
                                                            </div>
                                                            <div class="process-cart-total">
                                                                <p>Total:<span id="total">@if(isset($total))RS {{$total}}@endif</span></p>
                                                            </div>
                                                            <div class="process-checkout-btn text-right">
                                                                <a class="btn-def btn2" href="{{ route('checkout') }}">Proceed To Checkout</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- cart are end-->
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
        function increaseQuantity(id) {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var qty = parseInt($(".cart-plus-minus-box[data-id=" + id + "]").val());
            // console.log(qty);
            if (qty <=-1) {
                $(".cart-plus-minus-box[data-id=" + id + "]").val(0);
                toastr.error("Quantity should have a valid value");
                $.ajax({
                    url: "{{route('cart.update')}}",
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id,
                        qty: qty
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if(data.status == 400){
                            toastr.error("Sorry, this item can't be added because you have maximum quantity of the product in your cart");
                            $(".cart-plus-minus[data-id="+id+"]").html("");
                            $(".cart-plus-minus[data-id="+data.cart.id+"]").append(`<input style=" -moz-appearance: textfield;" value="` + data.cart.quantity + `" disabled="" name="qtybutton" class="cart-plus-minus-box" data-id="`+data.cart.id+`" min="1" max="10" type="number"><div class="inc qtybutton" onclick="increaseQuantity(`+data.cart.id+`)">+</div>`);
                            return false
                        }
                        console.log(data.cart_total);
                        $("#product_quantity").html("");
                        $("#product_quantity[data-id="+id+"]").html(data.cart.quantity);
                        $('#sub_total').text(data.cart_total);
                        $('#t_total').text(data.cart_total);
                        // $(".cart-plus-minus[data-id="+id+"]").html("");
                        $(".cart-plus-minus[data-id="+data.cart.id+"]").append(`<!--<input style=" -moz-appearance: textfield;" value="` + data.cart.quantity + `" disabled="" name="qtybutton" class="cart-plus-minus-box" data-id="`+data.cart.id+`" min="1" max="10" type="number"><div class="inc qtybutton" onclick="increaseQuantity(`+data.cart.id+`)">+</div>-->`);
                        $(".process-cart-total").html("");
                        $('.process-cart-total').append(
                            `
                        <p>Total:<span id="total">RS ` + data.cart_total + `</span></p>
                        `
                        );
                    }
                });
            } else {
                var qty = qty + 1;
                if (qty > 10) {
                    toastr.error("You can not purchase more then 10 products once")
                } else {
                    $.ajax({
                        url: "{{route('cart.update')}}",
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            id: id,
                            qty: qty
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            // console.log(data.cartQuan);
                            if(data.status == 400){
                                toastr.error("Sorry, this item can't be added because you have maximum quantity of the product in your cart");
                                // $(".cart-plus-minus[data-id="+id+"]").html("");
                                // $(".cart-plus-minus[data-id="+data.cart.id+"]").append(` <div class="dec qtybutton" onclick="decreaseQuantity(`+data.cart.id+`)">-</div><input style=" -moz-appearance: textfield;" value="` + data.cart.quantity + `" disabled="" name="qtybutton" class="cart-plus-minus-box" data-id="`+data.cart.id+`" min="1" max="10" type="number"><div class="inc qtybutton" onclick="increaseQuantity(`+data.cart.id+`)">+</div>`);
                                return false
                            }
                            $("#product_quantity[data-id=" + id + "]").html("");
                            $("#product_quantity[data-id=" + id + "]").html(data.cartQuan.quantity);
                            console.log(data.cart);
                            $(".process-cart-total").html("");
                            $('.process-cart-total').append(
                            `
                           <p>Total:<span id="total">RS ` + data.cart_total + `</span></p>
                           `
                            );

                        }
                    });
                }
            }
        }

        function decreaseQuantity(id) {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var qtys=parseInt($(".cart-plus-minus-box[data-id="+id+"]").val());
                console.log(qtys);
            if (qtys <=-1) {
                $(".cart-plus-minus-box[data-id=" + id + "]").val(0);
                $.ajax({
                    url: "{{route('cart.update')}}",
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id,
                        qty: qtys
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data.cart_total);

                        $('#sub_total').text(data.cart_total);
                        $('#t_total').text(data.cart_total);
                        $(".cart-plus-minus[data-id="+id+"]").html("");
                        $(".cart-plus-minus[data-id="+data.cart.id+"]").append(`<input style=" -moz-appearance: textfield;" value="` + data.cart.quantity + `" disabled="" name="qtybutton" class="cart-plus-minus-box" data-id="`+data.cart.id+`" min="1" max="10" type="number"><div class="inc qtybutton" onclick="increaseQuantity(`+data.cart.id+`)">+</div>`);
                        $(".process-cart-total").html("");
                        $('.process-cart-total').append(
                            `
                        <p>Total:<span id="total">RS ` + data.cart_total + `</span></p>
                        `
                        );
                    }
                });
            } else{
                var qty = qtys - 1;
                $.ajax({
                    url: "{{route('cart.update')}}",
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        id: id,
                        qty: qty,
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data.cart_total);
                        // $('.c_price' + id).text(price * qty);
                        $('#sub_total').text(data.cart_total);
                        $('#t_total').text(data.cart_total);
                        $(".process-cart-total").html("");
                        $('.process-cart-total').append(
                            `
                        <p>Total:<span id="total">RS `+data.cart_total+`</span></p>
                        `
                        );
                    }
                });
            }
        }

        function checkCoupon() {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var coupon = $("#coupon").val();
            console.log(coupon);
            $.ajax({
                url: "{{route('coupon.check')}}",
                type: 'get',
                data: {
                    _token: CSRF_TOKEN,
                    coupon: coupon,
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == -2){
                        toastr.error("Coupon is used")
                    }
                    if(data.status == 200){
                        toastr.success("Your coupon is valid and approved")
                    } else {
                        if(data.status == -1){
                            toastr.error(" Your coupon is invalid")
                        }
                    }


                }
            });

        }
    </script>

    <script>
        (function() {

            window.inputNumber = function(el) {

                var min = el.attr('min') || false;
                var max = el.attr('max') || false;

                var els = {};

                els.dec = el.prev();
                els.inc = el.next();

                el.each(function() {
                    init($(this));
                });

                function init(el) {

                    els.dec.on('click', decrement);
                    els.inc.on('click', increment);

                    function decrement() {
                        var value = el[0].value;
                        value--;
                        if(!min || value >= min) {
                            el[0].value = value;
                        }
                    }

                    function increment() {
                        var value = el[0].value;
                        value++;
                        if(!max || value <= max) {
                            el[0].value = value++;
                        }
                    }
                }
            }
        })();

        inputNumber($('.input-number'));
    </script>

    <script>
    </script>

    @endsection